<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'class' => 'form-horizontal',
    ]); ?>

    <div class="d-flex">
        <?= $form->field($model, 'searchstring', ['options' => ['class' => 'form-group mb-0']])->textInput(['maxlength' => true, 'placeholder' => 'جستجو ...', 'class'=> 'form-control form-control-sm'])->label(false) ?>
        <?= Html::submitButton('جستجو', ['class' => 'btn btn-sm btn-outline-info ml-2']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
