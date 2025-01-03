<?php

use common\helpers\UrlHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = 'Palheiro'
?>
<!-- Product Section Begin -->
<section>
    <div class="container">
        <div class="filter__item" style="border-top:0;">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="hero__search__form">
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
        </div>
        <section class="featured spad" style="padding-top:30px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>Categorias</h2>
                        </div>
                        <div class="featured__controls">
                            <ul>
                                <li class="active" data-filter="*">Todas</li>
                                <?php foreach ($categorias as $categoria): ?>
                                    <li data-filter=".<?= $categoria->nome ?>"><?= $categoria->nome ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row featured__filter">
                    <?php foreach ($produtos as $produto): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mix <?= Html::encode($produto->categoria->nome) ?>">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" data-setbg="<?= UrlHelper::getProductImageUrl($produto->imagens[0]->ficheiro) ?>">
                                    <ul class="featured__item__pic__hover">
                                        <li>
                                            <form action="<?= Url::to(['produto/add-to-cart']) ?>" method="post" style="display: inline;">
                                                <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                                                <?= Html::hiddenInput('produto_id', $produto->id) ?>
                                                <button type="submit" style="all: unset;">
                                                    <a><i class="fa fa-shopping-cart"></i></a>
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <a href="<?= Url::to(['produto/show', 'id' => $produto->id]) ?>">
                                                <i class="fa fa-magnifying-glass"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6>
                                        <a href="<?= Url::to(['produto/show', 'id' => $produto->id]) ?>">
                                            <?= Html::encode($produto->nome) ?>
                                        </a>
                                    </h6>
                                    <h5><?= Html::encode($produto->preco) ?>€</h5>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div>
                    <?= LinkPager::widget([
                        'pagination' => $pagination,
                        'nextPageLabel' => 'Next',
                        'prevPageLabel' => 'Previous',
                        'maxButtonCount' => 5,
                        'options' => ['class' => 'pagination class-style-pagination'],
                        'linkOptions' => ['class' => 'page-link'],
                    ]) ?>
                </div>
            </div>
        </section>
</section>
<!-- Product Section End -->