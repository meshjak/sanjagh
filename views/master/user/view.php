<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->getUsername();
YiiAsset::register($this);

$masterUrl = Url::toRoute('master/master/index', true);
$userIndexUrl = Url::toRoute('master/user/index', true);

?>

<!-- user index -->
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1">کاربران</h5>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="<?= $masterUrl ?>" class="disabled"><i class="bx bx-home-alt"></i></a>
                        <li class="breadcrumb-item"><a href="<?= $userIndexUrl ?>" class="disabled">کاربران</a>
                        <li class="breadcrumb-item active">جزئیات کاربر <span>(نام کاربری : <?= Html::encode($this->title) ?>)</span></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-body">
    <section id="user-table">
        <div class="row row justify-content-center">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <p>
                            <?= Html::a('بروزرسانی', ['update', 'id' => $model->id], ['class' => 'btn btn-light-primary']) ?>
                            <?= Html::a('حذف', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-light-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </p>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <?= DetailView::widget([
                                'model' => $model,
                                'options' => [
                                    'class' => 'table zero-configuration border-top',
                                ],
                                'attributes' => [
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'label' => 'شناسه',
                                        'value' => function ($data) {
                                            return $data->id;
                                        },
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'label' => 'نام',
                                        'value' => function ($data) {
                                            return $data->fullname;
                                        },
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'label' => 'نام کاربری',
                                        'value' => function ($data) {
                                            return $data->username;
                                        },
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'label' => 'ایمیل',
                                        'value' => function ($data) {
                                            return $data->email;
                                        },
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'label' => 'وضعیت',
                                        'value' => function ($data) {
                                            return $data->status ? 'فعال' : 'غیرفعال';
                                        },
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'label' => 'مدیر',
                                        'value' => function ($data) {
                                            return $data->isAdmin ? 'هست' : 'نیست';
                                        },
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'label' => 'تاریخ ایجاد حساب',
                                        'value' => function ($data) {
                                            return $data->created_at;
                                        },
                                    ],
                                ],
                            ]) ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!--/ user index -->
