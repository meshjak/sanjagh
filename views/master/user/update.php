<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Update User: ' . $model->getUsername();

$masterUrl = Url::toRoute('master/master/index', true);
$userIndexUrl = Url::toRoute('master/user/index', true);
?>

<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1">ویرایش کاربر</h5>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="<?= $masterUrl ?>" class="disabled"><i class="bx bx-home-alt"></i></a>
                        <li class="breadcrumb-item"><a href="<?= $userIndexUrl ?>" class="disabled">کاربران</a>
                        <li class="breadcrumb-item active">ویرایش کاربر <span>(نام کاربری : <?= Html::encode($model->getUsername()) ?>)</span></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <div class="user-update row justify-content-center">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">فرم ویرایش اطلاعات کاربر
                        <span>(<?= Html::encode($model->getUsername()) ?>)</span></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <?= $this->render('_form', [
                            'model' => $model,
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

