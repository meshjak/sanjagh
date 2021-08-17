<?php

use app\models\Comment;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'کامنت ها';
$this->params['breadcrumbs'][] = $this->title;

$master = Url::toRoute('master/master/index', true);
?>

<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1">کامنت ها</h5>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="<?= $master ?>" class="disabled"><i class="bx bx-home-alt"></i></a>
                        <li class="breadcrumb-item active">کامنت ها</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-body">
    <section id="user-table">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'summary' => false,
//        'filterModel' => $searchModel,
                                'options' => [
                                    'class' => 'table-responsive',
                                ],
                                'tableOptions' => [
                                    'class' => 'table zero-configuration',
                                ],
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'label' => Comment::attributeLabels()['user_id'],
                                        'content' => function($data){
                                            return Html::a(
                                                StringHelper::truncate(Html::encode($data->user->username), 20),
                                                ['master/user/view', 'id' => $data->user->id],
                                                [
                                                    'title' => 'نمایش کاربر',
                                                    'data-pjax' => '0',
                                                ]
                                            );
                                        }
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'label' => Comment::attributeLabels()['body'],
                                        'content' => function($data){
                                            return Html::a(
                                                StringHelper::truncate(Html::encode($data->body), 40),
                                                ['master/comment/view', 'id' => $data->id],
                                                [
                                                    'title' => 'نمایش کاربر',
                                                    'data-pjax' => '0',
                                                ]
                                            );
                                        }
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'label' => Comment::attributeLabels()['article_id'],
                                        'content' =>  function($data) {
                                            return Html::a(
                                                StringHelper::truncate(Html::encode($data->article->title), 15),
                                                ['/article/view', 'id' => $data->article->id],
                                                [
                                                    'title' => 'ویرایش',
                                                    'data-pjax' => '0',
                                                ]
                                            );
                                        },
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'label' => Comment::attributeLabels()['status'],
                                        'value' =>  function($data) {
                                            return $data->status ? 'فعال' : 'غیرفعال';
                                        },
                                    ],
                                    //'created_at',
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{view}{update}{delete}',
                                        'buttons' => [
                                            'update' => function ($url) {
                                                return Html::a(
                                                    '<i class="bx bx-edit-alt mr-1"></i>',
                                                    $url,
                                                    [
                                                        'title' => 'ویرایش',
                                                        'data-pjax' => '0',
                                                    ]
                                                );
                                            },
                                            'delete' => function ($url) {
                                                return Html::a(
                                                    '<i class="bx bx-trash mr-1"></i>',
                                                    $url,
                                                    [
                                                        'title' => 'حذف',
                                                        'data-pjax' => '0',
                                                        'data-method' => 'post',
                                                        'aria-label'=> "Delete",
                                                        'data-confirm' => 'می خواهید آیتم مورد نظر را حذف کنید؟'
                                                    ]
                                                );
                                            },
                                            'view' => function ($url, $data) {
                                                return Html::a(
                                                    '<i class="bx bx-show mr-1"></i>',
                                                    ['master/comment/view', 'id' => $data->id],
                                                    [
                                                        'title' => 'مشاهده',
                                                        'data-pjax' => '0',
                                                    ]
                                                );
                                            },
                                        ],
                                    ],

                                ],
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
