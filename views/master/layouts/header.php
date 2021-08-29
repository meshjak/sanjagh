<?php

use yii\helpers\Html;

?>
<!-- BEGIN: Header-->
<div class="header-navbar-shadow"></div>
<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon bx bx-menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav bookmark-icons">
<!--                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="" data-toggle="tooltip" data-placement="bottom" title="ایمیل"><i class="ficon bx bx-envelope"></i></a></li>-->
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                    <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon bx bx-search"></i></a>
                        <div class="search-input">
                            <div class="search-input-icon"><i class="bx bx-search primary"></i></div>
                            <label>
                                <input class="input" type="text" placeholder="جستجو ..." tabindex="-1" data-search="template-search">
                            </label>
                            <div class="search-input-close"><i class="bx bx-x"></i></div>
                            <ul class="search-list"></ul>
                        </div>
                    </li>
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name"><?= Yii::$app->user->identity->username ?></span><span class="user-status text-muted">آماده</span></div></a>
                        <div class="dropdown-menu pb-0"><a class="" href="">
                                <?= Html::beginForm(['/site/logout'], 'post') .
                                Html::submitButton(
                                    'خروج',
                                    ['class' => 'btn ']
                                ). Html::endForm()
                                ?></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->