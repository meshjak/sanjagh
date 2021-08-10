<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(['options' => ['class' =>'form form-horizontal'], 'fieldConfig' => ['template' => '
    <div class="row">
        <div class="col-md-4">{label}</div>
        <div class="col-md-8 form-group position-relative">
            {input}
            <div class="text-sm text-danger position-absolute font-weight-light" style="font-size: .8rem; padding-top: 1px; padding-right: 10px">
                {error}{hint}
            </div>
        </div>
    </div>
    ']]); ?>

        <?= $form->field($model, 'fullname')->textInput(['maxlength' => true, 'placeholder' => $model->attributeLabels()['fullname']]) ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => $model->attributeLabels()['username']]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => $model->attributeLabels()['email']]) ?>

        <?php if ($model->isCreate()) { ?>
            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => $model->attributeLabels()['password']]); ?>
            <?= $form->field($model, 'password_repeat')->passwordInput(['class' => 'form-control', 'placeholder' => $model->attributeLabels()['password_repeat']]); ?>
        <?php } ?>

        <?= $form->field($model, 'isAdmin')->dropdownList([0 => 'نیست', 1 => 'هست'],
            [$model->getStatus() => ['selected' => true], 'class' => 'form-control', 'placeholder' => $model->attributeLabels()['isAdmin']]) ?>

        <?= $form->field($model, 'status')->dropdownList([0 => 'غیرفعال', 1 => 'فعال'],
            [$model->getStatus() => ['selected' => true], 'class' => 'form-control', 'placeholder' => $model->attributeLabels()['status']]) ?>
    <div class=" col-12 form-group d-flex justify-content-end">
        <?= Html::submitButton('ثبت', ['class' => 'btn btn-primary mr-1 mb-1']) ?>
        <?= Html::resetButton('بازنشانی', ['class' => 'btn btn-light-secondary mb-1']) ?>
    </div>
<?php ActiveForm::end(); ?>