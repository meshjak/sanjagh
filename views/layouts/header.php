<header>
    <?php

    use yii\bootstrap4\Html;
    use yii\helpers\Url;

    $homeUrl = Url::toRoute('/article', true);
    $contactUsUrl = Url::toRoute('/contact', true);
    $aboutUrl = Url::toRoute('/about', true);

    $loginUrl = Url::toRoute('/login', true);
    $registerUrl = Url::toRoute('/register', true);
    $logoutUrl = Url::toRoute('/logout', true);
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top pb-0">
        <div class="container-lg">
            <a href="<?= $homeUrl ?>" class="d-flex align-items-center p-1 text-secondary text-decoration-none
                <?= Yii::$app->controller->getRoute() == 'article/index' ? 'border-bottom border-info' : '' ?>">
                <span>
                    <img class="round text-info" src="<?= Yii::getAlias('@web/image').'/logo/sanjagh.png' ?>" alt="avatar" height="30" width="30">
                </span>
                <div class="d-sm-flex d-none">
                    سنجاق
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-lg-flex justify-content-lg-between" id="navbarNavDropdown">
                <ul class="navbar-nav mr-lg-3">
                    <li class="nav-item">
                        <a class="nav-link
                        <?= Yii::$app->controller->getRoute() == 'site/contact' ? 'border-bottom border-info' : '' ?> "
                           href="<?= $contactUsUrl ?>">ارتباط با ما</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= Yii::$app->controller->getRoute() == 'site/about' ? 'border-bottom border-info' : '' ?>"
                           href="<?= $aboutUrl ?>">درباره ما</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if(!Yii::$app->user->isGuest): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= Yii::$app->user->identity->fullname ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">پروفایل</a>
                            <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline']) .
                                Html::submitButton(
                                'خروج',
                                ['class' => 'dropdown-item btn btn-link logout']
                            ). Html::endForm()
                            ?>
                        </div>
                    </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $loginUrl ?>">ورود</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $registerUrl ?>">ثبت نام</a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
