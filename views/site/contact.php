<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;

$this->title = 'Contact';
?>

<div class="site-contact">
    <div class="row  d-flex justify-content-center">
        <div class="col-11 col-lg-8">
            <div class="card mt-5 position-relative rounded-0 border-dark shadow-md">
                <img class="round text-info position-absolute" style="top: -1.75rem; right: -2.25rem"  src="<?= Yii::getAlias('@web/image').'/logo/sanjagh.png' ?>" alt="avatar" height="70" width="70">
                <div class="card-body">
                    <h3 class="font-weight-lighter ml-lg-4 ml-3 border-bottom border-info pb-1">ارتباط با ما</h3>
                    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
                        <div class="alert alert-success mt-3">
                            از اینکه با ما تماس گرفتید، متشکریم. ما به شما در اسرع وقت پاسخ خواهیم داد.
                        </div>

                    <?php else: ?>

                        <p>
                            لطفاً فرم زیر را برای تماس با ما پر کنید. متشکرم
                        </p>

                        <?php $form = ActiveForm::begin([
                            'id' => 'contact-form',
                            'fieldConfig' => [
                                'template' => "<div>{label}</div><div>{input}</div><div>{error}</div>",
                                'labelOptions' => ['class' => ''],
                            ],
                        ]); ?>

                        <?= $form->field($model, 'name')->textInput(['autofocus' => true])->error(['class' => 'help-block is-invalid']) ?>

                        <?= $form->field($model, 'email')->error(['class' => 'help-block is-invalid']) ?>

                        <?= $form->field($model, 'subject')->error(['class' => 'help-block is-invalid']) ?>

                        <?= $form->field($model, 'body')->textarea(['rows' => 6])->error(['class' => 'help-block is-invalid']) ?>

                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                        ])->error(['class' => 'help-block is-invalid']) ?>

                        <div class="form-group">
                            <?= Html::submitButton('ارسال', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-contact">
</div>
