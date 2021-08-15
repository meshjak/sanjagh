<?php

namespace app\controllers\master;

use app\models\Article;
use app\models\ArticleSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    public $layout = '@app/views/master/layouts/base';

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'denyCallback' => function ($rule, $action) {
                        throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
                    },
                    'only' => ['*'],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index'],
                            'roles' => ['listArticle'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['status'],
                            'roles' => ['statusArticle'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['viewDetailsArticle'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['deleteArticle'],
                        ],

                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param int $id شناسه
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id شناسه
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionStatus($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            $model->status = $model->status ? 0 : 1;
            $model->save();
        }
        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id شناسه
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id شناسه
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
}
