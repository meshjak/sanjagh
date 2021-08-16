<?php

use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $pages yii\data\Pagination */

$this->title = 'مقالات';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">
    <div class="d-flex justify-content-between align-items-center mb-3 pb-1">
        <h3><?= Html::encode($this->title) ?></h3>

        <?php if(!Yii::$app->user->isGuest):  ?>
        <div>
            <?= Html::a('ایجاد مقاله جدید', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
        </div>
        <?php endif ?>
    </div>


<!--    --><?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_article_item',
        'layout' => "{items}<div class='d-flex justify-content-center'>{pager}</div>"
    ]) ?>


</div>
