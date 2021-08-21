<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Tag */

$this->title = 'Create Tag';
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$masterUrl = Url::toRoute('master/master/index', true);
$tagIndexUrl = Url::toRoute('master/tag/index', true);
?>


<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1">ایجاد تگ جدید</h5>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="<?= $masterUrl ?>" class="disabled"><i class="bx bx-home-alt"></i></a>
                        <li class="breadcrumb-item"><a href="<?= $tagIndexUrl ?>" class="disabled">تگ ها</a>
                        <li class="breadcrumb-item active">ایجاد تگ جدید</li>
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
                    <h4 class="card-title">فرم ثبت اطلاعات تگ جدید</h4>
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
