<?php

/* @var $this \yii\web\View */
/* @var $content string */

use kartik\icons\Icon;
Icon::map($this);

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100" dir="rtl">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.0.0/dist/font-face.css" rel="stylesheet" type="text/css" />
</head>
<body class="d-flex flex-column h-100" style="font-family: 'Vazir', sans-serif">
<?php $this->beginBody() ?>

<!-- BEGIN: header-->
<?= Yii::$app->view->renderFile('@app/views/layouts/header.php'); ?>
<!-- END: header-->

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<!-- BEGIN: footer-->
<?= Yii::$app->view->renderFile('@app/views/layouts/footer.php'); ?>
<!-- END: footer-->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
