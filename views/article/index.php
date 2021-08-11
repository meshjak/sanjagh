<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'مقالات';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">
    <div class="d-flex justify-content-between align-items-center border-bottom mb-3 pb-1">
        <h3><?= Html::encode($this->title) ?></h3>

        <div>
            <?= Html::a('ایجاد مقاله جدید', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
        </div>
    </div>


<!--    --><?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_article_item'
    ]) ?>


</div>
