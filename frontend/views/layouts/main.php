<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\helpers\UrlHelper;
use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Palheiro</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader-container">
            <?= Html::img(UrlHelper::getCompanyImageUrl('palheiroLogo.png')) ?>
            <div class="loader"></div>
        </div>
    </div>

    <header>

        <?php
        NavBar::begin([
            'brandLabel' => Html::img(
                UrlHelper::getCompanyImageUrl(urlencode('palheiroLogo.png')),
                ['alt' => Yii::$app->name, 'style' => 'max-width: 40px; height: auto;']
            ),
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-light bg-light fixed-top',
            ],
        ]);

        $menuItems = [
            [
                'label' => 'Home',
                'url' => ['/site/index'],
                'options' => ['class' => Yii::$app->controller->id === 'site' ? 'active' : ''],
            ],
            [
                'label' => 'Produtos',
                'url' => ['/produto/index'],
                'options' => ['class' => Yii::$app->controller->id === 'produto' ? 'active' : ''],
            ],
            [
                'label' => 'Contactos',
                'url' => ['/contact/index'],
                'options' => ['class' => Yii::$app->controller->id === 'contact' ? 'active' : ''],
            ],
        ];

        if (!Yii::$app->user->isGuest) {
            $menuItems = array_merge($menuItems, [
                [
                    'label' => 'Faturas',
                    'url' => ['/fatura/index'],
                    'options' => ['class' => Yii::$app->controller->id === 'fatura' ? 'active' : ''],
                ],
                [
                    'label' => 'Carrinho',
                    'url' => ['/carrinho/index'],
                    'options' => ['class' => Yii::$app->controller->id === 'carrinho' ? 'active' : ''],
                ],
            ]);
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
            'items' => $menuItems,
        ]);

        if (Yii::$app->user->isGuest) {
            echo Html::tag(
                'div',
                Html::a(
                    'Login',
                    ['/site/login'],
                    ['class' => ['btn btn-link login text-dark text-decoration-none fa fa-user']]
                ),
                ['class' => ['d-flex']]
            );
            echo Html::tag(
                'div',
                Html::a(
                    'Signup',
                    ['/site/signup'],
                    ['class' => ['btn btn-link login text-dark text-decoration-none fa']]
                ),
                ['class' => ['d-flex']]
            );
        } else {
            echo Html::a(
                '<i class="fa fa-user"></i> Perfil',
                ['/profile/index'],
                ['class' => 'btn text-decoration-none'],
            );
            echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    [
                        'class' => 'btn btn-link logout text-decoration-none text-dark',
                        'style' => 'margin-top: -3px;'
                    ]
                )
                . Html::endForm();
        }


        NavBar::end();
        ?>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <ul>
                            <li>Morada: Leiria, Leiria</li>
                            <li>Email: exemplo@palheiro.pt</li>
                        </ul>
                    </div>
                </div>
                <?= Html::img(UrlHelper::getCompanyImageUrl('palheiroLogo.png'), ['style' => 'width:auto; height:72px;']) ?>
            </div>
        </div>
        <div class="container">
            <p class="float-start">&copy; <?= Html::encode('Palheiro') ?> <?= date('Y') ?></p>
            <p class="float-end"><?= Yii::powered() ?></p>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Floating Cart Button -->
    <?php
    // Pages where the button should NOT appear
    $excludedRoutes = [
        'profile/index',
        'site/login',
        'site/signup',
        'contact/index',
        'carrinho/index',
    ];

    $currentRoute = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;

    if (!in_array($currentRoute, $excludedRoutes)): ?>
        <div class="floating-cart-button">
            <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-cart-shopping']), ['/carrinho/index'], ['class' => 'btn btn-primary']) ?>
        </div>
    <?php endif; ?>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
