<?php

namespace app\controllers\master;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class MasterController extends Controller
{
    public $layout = '@app/views/master/layouts/base';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));

                },
                'only' => ['*'],
                'rules' => [
                    [
                        'roles' => ['@'], // user
                        'allow' => true, // access to
                        'actions' => ['index'], // index action
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->isAdmin == 1;
                        }
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        return $this->render('@app/views/master/index');
    }
}
