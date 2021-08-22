<?php

use app\models\Tag;use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $pages yii\data\Pagination */

?>
<div class="article-index">
    <div class="d-flex justify-content-between align-items-center mb-1 mb-lg-3 pb-1">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        <?php if(!Yii::$app->user->isGuest):  ?>
        <div>
            <?= Html::a('ایجاد مقاله جدید', ['create'], ['class' => 'btn btn-sm btn-info']) ?>
        </div>
        <?php endif ?>
    </div>
    <div class="row d-lg-none">
        <div class="col-12  mb-2">
            <div class="tags bg-light py-1 px-2 rounded shadow-sm">
                <?php foreach (Tag::find()->all() as $tag): ?>
                    <span class="badge badge-info"><?= Html::encode($tag->name)  ?></span>
                <?php endforeach ?>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-8">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item'],
                'itemView' => '_article_item',
                'layout' => "{items}<div class='d-flex justify-content-center'>{pager}</div>"
            ]) ?>
        </div>
        <div class="col-lg-4 d-none d-lg-block">
            <div class="card">
                <div class="card-header">تگ ها</div>
                <div class="card-body">
                    <?php foreach (Tag::find()->all() as $tag): ?>
                        <span class="badge badge-info"><?= Html::encode($tag->name)  ?></span>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>


</div>
