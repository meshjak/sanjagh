<?php

use app\models\Tag;
use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tags';
$this->params['breadcrumbs'][] = $this->title;

$action = '';
$action .= Yii::$app->user->can('viewDetailsTag') ? '{view}' : '';
$action .= Yii::$app->user->can('deleteTag') ? '{delete}' : '';
$action .= Yii::$app->user->can('updateTag') ? '{update}' : '';

$masterUrl = Url::toRoute('master/master/index', true);
?>


<!-- tag index -->
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1">تگ ها</h5>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="<?= $masterUrl ?>" class="disabled"><i class="bx bx-home-alt"></i></a>
                        <li class="breadcrumb-item active">تگ ها</li>
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
                    <div class="card-header d-flex justify-content-end">
                        <?php if (Yii::$app->user->can('createTag')): ?>
                            <div><?= Html::a('ایجاد تگ جدید', ['master/tag/create'],['class' => 'btn btn-light-primary mb-1']) ?></div>
                        <?php endif ?>
                    </div>
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
                                    'name',
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'label' => Tag::attributeLabels()['user_id'],
                                        'content' => function($data){
                                            return Yii::$app->user->can('viewDetailsUser')? Html::a(
                                                StringHelper::truncate(Html::encode($data->user->username), 20),
                                                ['master/user/view', 'id' => $data->user->id],
                                                [
                                                    'title' => 'نمایش کاربر',
                                                    'data-pjax' => '0',
                                                ]
                                            ) : $data->user->username;
                                        }
                                    ],
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => $action,
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
                                                        'data-confirm' => 'آیا شما مطمئن هستید می خواهید آیتم مورد نظر را حذف کنید؟'
                                                    ]
                                                );
                                            },
                                            'view' => function ($url) {
                                                return Html::a(
                                                    '<i class="bx bx-show mr-1"></i>',
                                                    $url,
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
<!--/ tag index -->
