<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="d-flex">
        <?= $form->field($model, 'searchstring', ['options' => ['class' => 'form-group mb-0']])->textInput(['maxlength' => true, 'placeholder' => 'جستجو ...', 'class'=> 'form-control form-control-sm'])->label(false) ?>
        <?= Html::submitButton('جستجو', ['class' => 'btn btn-sm btn-light-primary ml-1']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
