<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = 'بروزرسانی مقاله: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'مقالات', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'بروزرسانی';
?>
<div class="article-update">

    <h4 class="mb-4"><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
