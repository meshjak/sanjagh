<?php

namespace app\controllers\master;

use yii\web\Controller;

class MasterController extends Controller
{
    public $layout = '@app/views/master/layouts/base';

    public function actionIndex(): string
    {
        return $this->render('@app/views/master/index');
    }
}
