<?php
/* @var $this yii\web\View */


use yii\helpers\Url;

$master = Url::toRoute('master/master/index', true)
?>


<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1">داشبورد</h5>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="<?= $master ?>" class="disabled"><i class="bx bx-home-alt"></i></a>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <p>
        شما می توانید محتوای این صفحه را در آدرس فایل مقابل تغییر دهید
        <code><?= __FILE__; ?></code>.
    </p>
</div>
