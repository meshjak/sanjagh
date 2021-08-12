<?php

use app\models\Article;
use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'مقالات';
$this->params['breadcrumbs'][] = $this->title;

$masterUrl = Url::toRoute('master/master/index', true);
?>

<!-- article index -->
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1">مقالات</h5>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="<?= $masterUrl ?>" class="disabled"><i class="bx bx-home-alt"></i></a>
                        <li class="breadcrumb-item active">مقالات</li>
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
                    <!--<div class="card-header d-flex justify-content-end"></div>-->
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
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
                                        'label' => Article::attributeLabels()['title'],
                                        'value' => function ($data) {
                                            return StringHelper::truncate(Html::encode($data->title), 45);
                                        },
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'label' => User::attributeLabels()['username'] . ' ' . Article::attributeLabels()['author_id'],
                                        'value' => function ($data) {
                                            return $data->author->username;
                                        },
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'label' => Article::attributeLabels()['status'],
                                        'content' => function ($data) {
                                            $statusReverse = !$data->status ? 'فعال' : 'غیرفعال';
                                            return Html::a(
                                                $data->status ? 'فعال' : 'غیرفعال',
                                                ['master/article/status', 'id' => $data->id],
                                                [
                                                    'title' => 'حذف',
                                                    'data-pjax' => '0',
                                                    'data-method' => 'post',
                                                    'aria-label'=> "Status",
                                                    'data-confirm' => 'وضعیت آیتم مورد نظر به '. $statusReverse .' تغییر دهید؟'
                                                ]
                                            );
                                        },
                                    ],
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{download} {view} {delete}',
                                        'buttons' => [
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
                                                    ['article/view', 'id' => $data->id],
                                                    [
                                                        'title' => 'مشاهده',
                                                        'data-pjax' => '0',
                                                    ]
                                                );
                                            },
                                        ],
                                    ],
                                ],
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!--/ article index -->
