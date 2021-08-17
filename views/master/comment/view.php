<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Comment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);

$masterUrl = Url::toRoute('master/master/index', true);
$commentIndexUrl = Url::toRoute('master/comment/index', true);
?>

<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1">جزئیات نظر</h5>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="<?= $masterUrl ?>" class="disabled"><i class="bx bx-home-alt"></i></a>
                        <li class="breadcrumb-item"><a href="<?= $commentIndexUrl ?>" class="disabled">نظرات</a>
                        <li class="breadcrumb-item active">جزئیات نظر</li>
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
                                    'id',
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'label' => 'فرستنده',
                                        'value' => function ($data) {
                                            return $data->user->username;
                                        },
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'label' => 'مقاله',
                                        'value' => function ($data) {
                                            return $data->article->title;
                                        },
                                    ],
                                    'body',
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'label' => 'وضعیت',
                                        'value' => function ($data) {
                                            return $data->status ? 'فعال' : 'غیرفعال';
                                        },
                                    ],
                                    'created_at',
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
