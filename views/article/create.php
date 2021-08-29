<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $tags  */

$this->title = 'ایجاد مقاله';
?>
<div class="article-create">

    <h3 class="mb-4"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'tags' => $tags
    ]) ?>

</div>
