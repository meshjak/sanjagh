<?php
    /** @var $model \app\models\Article */

use yii\helpers\Html;
?>

<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title mb-0"><?= Html::encode($model->title)  ?></div>
        <div><?= Html::a('ادامه مطلب', ['view', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?></div>
    </div>
    <div class="card-body"><?= Html::encode($model->description())  ?></div>
    <div class="card-footer d-flex justify-content-between align-items-center">
        <p class="mb-0">نویسنده: <span><?=  Html::encode($model->author->getFullname())  ?></span></p>
        <div><span><?= Html::encode($model->relativeCreateTime())  ?></span></div>
    </div>
</div>
