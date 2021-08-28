<?php

use kartik\icons\Icon;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;
/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $comments  */
/* @var $modelComment  */
/* @var $tags  */


$this->title = $model->title;
$currentUserIsAuthorArticle = $model->author_id === Yii::$app->user->id;
$userAccessDeleteArticle =
    $currentUserIsAuthorArticle || Yii::$app->user->can('deleteArticle');
YiiAsset::register($this);
?>


<div class="article-view">
    <div class="row">
        <div class="col-lg-9 mx-auto">
            <div class="header d-flex justify-content-between align-items-center mb-3">
                <h1><?= Html::encode($this->title) ?></h1>
                <div>
                    <span class="" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= Icon::show('cog', ['class' => 'fa-lg text-info', 'framework' => Icon::FAS]);  ?>
                    </span>
                    <div class="dropdown-menu px-1" aria-labelledby="dropdownMenuButton">
                        <div>
                            <?= $currentUserIsAuthorArticle ?
                                Html::a('بروزرسانی', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-outline-info d-block mb-1']) : '' ?>
                            <?= Yii::$app->user->can('statusArticle') ? Html::a($model->status ? 'فعال' : 'غیرفعال',
                                ['master/article/status', 'id' => $model->id],
                                [
                                    'class' => 'btn btn-sm btn-outline-warning d-block mb-1', 'data' => [
                                    'method' => 'post',
                                    'title' => 'وضعیت',
                                    'pjax' => 0
                                ],
                                ]) : '' ?>
                            <?= $userAccessDeleteArticle ? Html::a('حذف', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-sm btn-outline-danger d-block mb-1',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]) : '' ?>

                        </div>
                    </div>
                </div>

            </div>
            <div class="row d-flex align-items-center mb-3">
                <div class="col-lg-6">
                    <div>
                        <span><?=  Html::encode($model->author->fullname)  ?></span>
                        <span class="mx-1">/</span>
                        <span class="text-secondary" style="font-size: 14px"><?= Html::encode($model->relativeCreateTime())  ?></span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="d-flex float-right">
                        <a href="https://twitter.com/intent/tweet?text=<?= Url::toRoute(Yii::$app->controller->getRoute() . '?id=' . $model->id, true) ?>"
                           class="bg-light px-2 py-1 rounded ml-1">
                            <?= Icon::show('twitter', ['class' => 'fa-md text-info', 'framework' => Icon::FAB]);  ?>
                        </a>
                        <a class="bg-light px-2 py-1 rounded ml-1">
                            <?= Icon::show('facebook', ['class' => 'fa-md text-info', 'framework' => Icon::FAB]);  ?>
                        </a>
                        <a class="bg-light px-2 py-1 rounded ml-1">
                            <?= Icon::show('whatsapp', ['class' => 'fa-lg text-info', 'framework' => Icon::FAB]);  ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="content">
                <?php echo $model->body ?>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-9 mx-auto d-flex flex-wrap">
            <div class="px-3 py-2 border border-info ml-0 mr-2 mb-2">
                <?= Icon::show('tags', ['class' => 'fa-md text-info', 'framework' => Icon::FAS]);  ?>
                <span class="text-info mr-0 ml-2">تگ ها</span>
            </div>
            <?php foreach ($tags as $tag): ?>
                <div class="px-3 py-2 border border-info ml-0 mr-2 mb-2">
                    <span class="text-info mr-0 ml-2"><?= $tag->name ?></span>
                </div>

            <?php endforeach; ?>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-9 mx-auto">
            <div class="d-flex justify-content-between align-items-center">
                <div class="border-bottom border-info w-25 pb-1 pl-2">نظرات</div>
                <div>
                    <?php if (!Yii::$app->user->isGuest): ?>
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
                    <?php endif ?>
                </div>
            </div>
            <div>
                <?php if(count($comments) < 1): ?>
                    <div class="alert alert-warning mt-4" role="alert">
                        هنوز نظری ثبت نشده است!
                    </div>
                <?php endif ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="card mt-3 rounded-0" style="border:0;border-bottom: 0.7px dashed;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mb-2" style="font-size: 18px; font-weight: 500"><?= $comment->user->username ?></div>
                                <div class="">
                                    <span class="badge badge-secondary" id="modal"><?= Html::encode($comment->relativeCreateTime())  ?></span>
                                    <?php if (Yii::$app->user->can('deleteComment') || Yii::$app->user->can('statusComment')): ?>
                                        <span type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </span>
                                        <div class="dropdown-menu">
                                            <?php if(Yii::$app->user->can('deleteComment')): ?>
                                                <?= Html::a(
                                                    'حذف',
                                                    ['master/comment/delete', 'id' => $comment->id],
                                                    [
                                                        'class' => 'dropdown-item',
                                                        'title' => 'حذف',
                                                        'data-pjax' => '0',
                                                        'data-method' => 'post',
                                                        'aria-label'=> "Delete",
                                                        'data-confirm' => 'می خواهید آیتم مورد نظر را حذف کنید؟'
                                                    ]
                                                );
                                                ?>
                                            <?php endif ?>
                                            <?php if(Yii::$app->user->can('statusComment')): ?>
                                                <?php
                                                $statusReverse = !$comment->status ? 'فعال' : 'غیرفعال';
                                                $commentStatus = $comment->status ? 'فعال' : 'غیرفعال';
                                                echo Html::a(
                                                    'وضعیت : ' . $commentStatus ,
                                                    ['master/comment/status', 'id' => $comment->id],
                                                    [
                                                        'class' => 'dropdown-item',
                                                        'title' => 'وضعیت',
                                                        'data-pjax' => '0',
                                                        'data-method' => 'post',
                                                        'aria-label'=> "Status",
                                                        'data-confirm' => 'وضعیت آیتم مورد نظر به '. $statusReverse .' تغییر دهید؟'
                                                    ]
                                                );
                                                ?>
                                            <?php endif ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>

                            <?= $comment->body ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>