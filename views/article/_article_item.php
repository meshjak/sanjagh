<?php
    /** @var $model \app\models\Article */

use yii\helpers\Html;
?>

<div class="card mb-3">
    <div class="card-body">
        <div class="header text-secondary" style="font-size: 14px">
            <span><?=  Html::encode($model->author->getFullname())  ?></span>
            <span>/</span>
            <span><?= Html::encode($model->relativeCreateTime())  ?></span>
        </div>
        <div class="title mt-3" style="font-size: 20px"><?= Html::encode($model->title)  ?></div>
        <div class="content mt-3"><?= Html::encode($model->description)  ?></div>
        <div>
            <?= Html::a('ادامه مطلب', ['view', 'id' => $model->id], ['class' => 'btn btn-sm btn-outline-info mt-2 float-right']) ?>
        </div>
    </div>
</div>
