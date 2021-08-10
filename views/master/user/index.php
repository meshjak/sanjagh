<?php
use app\models\User;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';

$master = Url::toRoute('master/master/index', true);
?>

<!-- user index -->
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1">کاربران</h5>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="<?= $master ?>" class="disabled"><i class="bx bx-home-alt"></i></a>
                        <li class="breadcrumb-item active">کاربران</li>
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
                        <div><?= Html::a('ایجاد کاربر جدید', ['master/user/create'],['class' => 'btn btn-light-primary mb-1']) ?></div>
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
                                    'fullname',
                                    'username',
                                    'email',
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'label' => User::attributeLabels()['status'],
                                        'value' => function ($data) {
                                            return $data->status ? 'فعال' : 'غیرفعال';
                                        },
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                                        'label' => User::attributeLabels()['isAdmin'],
                                        'value' => function ($data) {
                                            return $data->isAdmin ? 'هست' : 'نیست';
                                        },
                                    ],
                                    // 'created_at',
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{download} {view} {update} {delete}',
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
<!--/ user index -->
