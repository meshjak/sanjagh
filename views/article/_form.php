<?php

use Itstructure\CKEditor\CKEditor;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
/* @var $tags */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])
        ->error(['class' => 'help-block is-invalid']) ?>

    <div class="form-group">
    <?php
    // Without model and implementing a multiple select
    echo '<label class="control-label">تگ</label>';
    $tagsDefault = ArrayHelper::map($model->tags, 'id', 'id',);
    echo Select2::widget([
        'name' => 'tags',
        'data' => $tags,
        'value' => $tagsDefault,
        'options' => [
            'placeholder' => 'تگ های مرتبط را انتخاب کنید ...',
            'multiple' => true
        ],
    ]);
    ?>
        <?php
    echo $form->field($model, 'body')
        ->widget(
            CKEditor::className(),
            [
                'preset' => 'custom',
                'clientOptions' => [
                    'toolbarGroups' => [
                        [
                            'name' => 'undo'
                        ],
                        [
                            'name' => 'basicstyles',
                            'groups' => ['basicstyles', 'cleanup']
                        ],
                        [
                            'name' => 'colors'
                        ],
                        [
                            'name' => 'links',
                            'groups' => ['links', 'insert']
                        ],
                        [
                            'name' => 'others',
                            'groups' => ['others', 'about']
                        ],
                    ],
                    'allowedContent' => true,
                    'language' => 'fa',
                ]
            ]
        )->error(['class' => 'help-block is-invalid']);
    ?>
    </div>


    <div class="form-group">
        <?= Html::submitButton('ذخیره', ['class' => 'btn btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
