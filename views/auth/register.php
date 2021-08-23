<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\RegisterForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

?>
<div class="site-register">
    <div class="row justify-content-center align-items-center mt-lg-5">
        <div class="col-lg-5 col-md-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">عضویت در سایت</h4>


                    <?php $form = ActiveForm::begin([
                        'id' => 'register-form',
                        'fieldConfig' => [
                            'template' => "<div>{label}</div><div>{input}</div><div>{error}</div>",
                            'labelOptions' => ['class' => 'control-label'],
                        ],
                    ]); ?>

                    <?= $form->field($model, 'fullname')->textInput(['autofocus' => true])->label('نام') ?>
                    <?= $form->field($model, 'username')->textInput()->label('نام کاربری') ?>
                    <?= $form->field($model, 'email')->textInput()->label('ایمیل') ?>
                    <?= $form->field($model, 'password')->passwordInput()->label('رمزعبور') ?>
                    <?= $form->field($model, 'password_repeat')->passwordInput()->label('تکرار رمزعبور') ?>

                    <div class="form-group">
                        <?= Html::submitButton('ثبت نام', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
