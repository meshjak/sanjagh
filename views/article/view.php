<?php

use yii\helpers\Html;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'مقالات', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="article-view">

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3><?= Html::encode($this->title) ?></h3>
            <div>
                <?= Html::a('بروزرسانی', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
                <?= Html::a($model->status ? 'فعال' : 'غیرفعال', ['master/article/status', 'id' => $model->id], ['class' => 'btn btn-sm btn-warning', 'data' => [
                    'method' => 'post',
                    'title' => 'وضعیت',
                    'pjax' => 0
                ],]) ?>
                <?= Html::a('حذف', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-sm btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>

            </div>
        </div>
        <div class="card-body">
            <?= Html::encode($model->body) ?>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <p class="mb-0">نویسنده: <span><?=  Html::encode($model->author->getFullname())  ?></span></p>
            <div><span><?= Html::encode($model->relativeCreateTime())  ?></span></div>
        </div>
    </div>
</div>
