<?php

use yii\helpers\Url;
?>
<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="">
                    <div class="brand-logo"><img class="logo" src="<?= Yii::getAlias('@web/master_asset').'/images/logo/logo.png' ?>" alt="logo sanjage"></div>
                    <h2 class="brand-text mb-0">Frest</h2></a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
            <li class=" navigation-header"><span>برنامه ها</span>
            </li>

            <?php if ( Yii::$app->user->can('listUser') || Yii::$app->user->can('createUser')): ?>
                <li class=" nav-item"><a href="#"><i class="bx bxs-group" data-icon="notebook"></i><span class="menu-title" data-i18n="Invoice">مدیریت کاربران</span></a>
                    <ul class="menu-content">

                        <?php if ( Yii::$app->user->can('listUser')): ?>
                            <li><a href="<?= Url::toRoute('master/user/index', true); ?>"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">لیست کاربران</span></a>
                            </li>
                        <?php endif ?>

                        <?php if ( Yii::$app->user->can('createUser')): ?>
                            <li><a href="<?= Url::toRoute('master/user/create', true); ?>"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice">ایجاد کاربر جدید</span></a>
                        </li>
                        <?php endif ?>
                    </ul>
                </li>
            <?php endif ?>

            <?php if (Yii::$app->user->can('listArticle')): ?>
                <li class=" nav-item"><a href="<?= Url::toRoute('master/article/index', true); ?>"><i class="bx bxs-notepad" data-icon="envelope-pull"></i><span class="menu-title" data-i18n="Email">مدیریت مقالات</span></a>
                </li>
            <?php endif ?>
            <?php if (Yii::$app->user->can('listComment')): ?>
                <li class=" nav-item"><a href="<?= Url::toRoute('master/comment/index', true); ?>"><i class="bx bxs-comment-detail" data-icon="envelope-pull"></i><span class="menu-title" data-i18n="Comment">مدیریت نظرات</span></a>
                </li>
            <?php endif ?>
            <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="notebook"></i><span class="menu-title" data-i18n="Invoice">صورتحساب</span></a>
                <ul class="menu-content">
                    <li><a href=""><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">لیست صورتحساب ها</span></a>
                    </li>
                    <li><a href=""><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice">صورتحساب</span></a>
                    </li>
                </ul>
            </li>
            <li class="disabled nav-item"><a href="#"><i class="menu-livicon" data-icon="morph-preview"></i><span class="menu-title" data-i18n="Disabled Menu">گزینه غیرفعال</span></a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->