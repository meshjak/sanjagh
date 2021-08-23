<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>
<div class="">
    <div class="row justify-content-center align-items-center mt-lg-5">
        <div class="col-lg-5 col-md-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">ورود به سایت</h4>

                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'fieldConfig' => [
                            'template' => "<div>{label}</div><div>{input}</div><div>{error}</div>",
                            'labelOptions' => ['class' => ''],
                        ],
                    ]); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('نام کاربری') ?>

                    <?= $form->field($model, 'password')->passwordInput()->label('رمزعبور') ?>

                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    ])->label('به خاطر بسپار') ?>

                    <div class="form-group">
                        <div class="col-lg-11">
                            <?= Html::submitButton('ورود', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

