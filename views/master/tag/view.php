<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tag */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$masterUrl = Url::toRoute('master/master/index', true);
$tagIndexUrl = Url::toRoute('master/tag/index', true);
?>

<!-- user index -->
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1">تگ ها</h5>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="<?= $masterUrl ?>" class="disabled"><i class="bx bx-home-alt"></i></a>
                        <li class="breadcrumb-item"><a href="<?= $tagIndexUrl ?>" class="disabled">تگ ها</a>
                        <li class="breadcrumb-item active">جزئیات تگ <span>(<?= Html::encode($this->title) ?>)</span></li>
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
                                        'label' => 'ایجاد کننده',
                                        'value' => function($data){
                                            return Html::a(
                                                User::findOne($data->user_id)->getUsername(),
                                                ['master/user/view', 'id' => $data->id],
                                                [
                                                    'title' => 'ایجاد کننده',
                                                    'data-pjax' => '0',
                                                ]
                                            ) ;
                                        },
                                        'format' => 'raw'
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'label' => 'نام',
                                        'value' => function ($data) {
                                            return $data->name;
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

