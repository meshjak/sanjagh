<?php

namespace app\controllers;

use app\models\Article;
use app\models\ArticleSearch;
use app\models\Comment;
use app\models\Tag;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        /**
         * How many articles we want to display per page.
         * @var integer
         */
        $pageSize = 8;

        /**
         * Articles have to be published.
         * @var boolean
         */
        $published = true;

        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, $pageSize, $published);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($this->request->isPost && !Yii::$app->user->isGuest){
            $data = Yii::$app->request->post()['Comment'];
            $comment = new Comment();
            $comment->body = $data['body'];
            $comment->article_id = $model->id;
            $comment->user_id = Yii::$app->user->id;
            $comment->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $modelComment = new Comment();
        $comments = $model->comments()->where(['status' => 1])->orderBy(['created_at' => SORT_DESC])->all();
        $tags = $model->tags;
        return $this->render('view', [
            'model' => $model,
            'comments' => $comments,
            'modelComment' => $modelComment,
            'tags' => $tags
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();
        $tags = Tag::find()->all();
        $tags = ArrayHelper::map($tags, 'id', 'name',);
        if ($this->request->isPost && !Yii::$app->user->isGuest) {
            if ($model->load($this->request->post())) {
                $model->status = 0;
                if($model->save())
                    return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'tags' => $tags
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws ForbiddenHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tags = Tag::find()->all();
        $tags = ArrayHelper::map($tags, 'id', 'name',);
        if(!$this->checkOwnArticle($model))
            throw new ForbiddenHttpException('You are not allowed to update this article.');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'tags' => $tags
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws ForbiddenHttpException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if( !$this->checkOwnArticle($model) && !Yii::$app->user->can('deleteArticle'))
            throw new ForbiddenHttpException('You are not allowed to update this article.');

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function checkOwnArticle($model){
        return $model->author_id === Yii::$app->user->id;
    }
}
