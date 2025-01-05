<?php

/** @var yii\web\View $this */

use common\helpers\UrlHelper;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Palheiro';
?>

<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="hero__search d-flex justify-content-center align-items-center">
                <div class="hero__search__form ">
                    <div class="search-form">
                        <?php $form = ActiveForm::begin([
                            'method' => 'get',
                            'action' => ['produto/index'],
                        ]); ?>

                        <?=
                        $form->field($produtoSearch, 'nome')
                            ->textInput([
                                'placeholder' => 'Procure por produtos',
                                'value' => Yii::$app->request->get('nome')
                            ])->label(false)
                        ?>

                        <div class="form-group">
                            <?= Html::submitButton('Procurar', ['class' => 'site-btn']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <div class="hero__item set-bg" data-setbg="<?= UrlHelper::getCompanyImageUrl('banner.jpg') ?>">
                <div class="hero__text">
                    <span>Palheiro</span>
                    <h2>Bem-vindo<br />Loja "O Palheiro"</h2>
                    <p>O retalho onde a variedade é ampla e a frescura imbatível!</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php foreach ($categorias as $categoria): ?>
                    <a href="<?= Url::to(['produto/index', 'categoria_id' => $categoria->id]) ?>">
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="<?= UrlHelper::getCategoriesImageUrl($categoria->id . '.jpg') ?>">
                                <h5 style="background-color: #EEEEEE; padding: 10px; width: fit-content; margin-left: 75px;"><?= $categoria->nome ?></h5>
                            </div>
                        </div>
                    </a>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Banner Begin -->
<div class="banner mt-5">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="<?= UrlHelper::getCompanyImageUrl('bannerEntregas.jpg') ?>" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->