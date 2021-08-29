<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $tags */

$this->title = 'بروزرسانی مقاله: ' . $model->title;
?>
<div class="article-update">

    <h4 class="mb-4"><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
        'tags' => $tags
    ]) ?>

</div>
