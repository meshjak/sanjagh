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

    <?= $form->field($model, 'searchstring', ['options' => ['class' => 'form-group mb-0']])->textInput(['maxlength' => true, 'placeholder' => 'جستجو ...', 'class'=> 'form-control form-control-sm'])->label(false) ?>

    <?php ActiveForm::end(); ?>

</div>
