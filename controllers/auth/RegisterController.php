<?php

namespace app\controllers\auth;

use app\models\RegisterForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class RegisterController extends Controller
{
    /**
     * Register action.
     *
     * @return Response|string
     * @throws \yii\base\Exception
     */
    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->redirect(Yii::$app->getHomeUrl());
        }
        return $this->render('/auth/register', ['model' => $model]);
    }
}
