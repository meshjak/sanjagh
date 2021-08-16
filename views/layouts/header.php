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
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-lg">
            <a class="navbar-brand" href="#">سنجاق</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-lg-flex justify-content-lg-between" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= $homeUrl ?>">خانه<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $contactUsUrl ?>">ارتباط با ما</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $aboutUrl ?>">درباره ما</a>
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
