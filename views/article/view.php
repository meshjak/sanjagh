<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\web\YiiAsset;
/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $comments  */
/* @var $modelComment  */

//foreach ($comments as $comment){
//    var_dump($comment->body);die;
//}die;


$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'مقالات', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$currentUserIsAuthorArticle = $model->author_id === Yii::$app->user->id;
$userAccessDeleteArticle =
    $currentUserIsAuthorArticle || Yii::$app->user->can('deleteArticle');
YiiAsset::register($this);
?>
<div class="article-view">
    <div class="row">

    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3><?= Html::encode($this->title) ?></h3>
            <div>
                <?= $currentUserIsAuthorArticle ?
                    Html::a('بروزرسانی', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) : '' ?>
                <?= Yii::$app->user->can('statusArticle') ? Html::a($model->status ? 'فعال' : 'غیرفعال',
                    ['master/article/status', 'id' => $model->id],
                    [
                        'class' => 'btn btn-sm btn-warning', 'data' => [
                        'method' => 'post',
                        'title' => 'وضعیت',
                        'pjax' => 0
                    ],
                    ]) : '' ?>
                <?= $userAccessDeleteArticle ? Html::a('حذف', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-sm btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) : '' ?>

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

    <div class="row mt-3">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="">کامنت ها</div>
                    <?php
                    Modal::begin([
                        'title' => 'نظر خود را وارد کنید',
                        'toggleButton' => ['label' => 'نوشتن نظر', 'class' => 'btn btn-sm btn-info'],
                    ]); ?>

                    <?php $form = ActiveForm::begin([
                            'layout' => 'default',
                        ]); ?>


                    <?= $form->field($modelComment, 'body')->textarea(['rows' => 6])
                            ->error(['class' => 'help-block is-invalid']); ?>

                    <div class="form-group">
                        <?= Html::submitButton('ارسال', ['class' => 'btn btn-sm btn-info comment-form']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                    <?php Modal::end(); ?>
                </div>
                <div class="card-body">
                    <?php foreach ($comments as $comment): ?>
                        <div class="card mt-3">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class=""><?= $comment->user->username ?></div>
                                <span class="badge badge-secondary" id="modal"><?= Html::encode($comment->relativeCreateTime())  ?></span>
                            </div>
                            <div class="card-body"><?= $comment->body ?></div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>