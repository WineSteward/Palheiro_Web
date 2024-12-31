<?php

use common\helpers\UrlHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = 'Palheiro'
?>
<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Categorias</span>
                    </div>
                    <ul>
                        <?php foreach ($categorias as $categoria): ?>
                            <li>
                                <a href="<?= Url::to(['produto/index', 'categoria_nome' => $categoria->nome]) ?>">
                                    <?= Html::encode($categoria->nome) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-3">
                            <div class="hero__search__form ">
                                <div class="search-form">
                                    <?php $form = ActiveForm::begin([
                                        'method' => 'get',
                                        'action' => ['index'], // garante que vai par a action
                                    ]); ?>

                                    <?= $form->field($produtoSearch, 'nome')->textInput(['placeholder' => 'Procure por produtos'])->label(false) ?>

                                    <div class="form-group">
                                        <?= Html::submitButton('Procurar', ['class' => 'site-btn']) ?>
                                    </div>

                                    <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($dataProvider->models as $produto): ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="<?= UrlHelper::getProductImageUrl($produto->imagens[0]->ficheiro) ?>">
                                    <ul class="product__item__pic__hover">
                                        <li>
                                            <a href="<?= Url::to(['produto/show', 'id' => $produto->id]) ?>">
                                                <i class="fa fa-magnifying-glass"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
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
                    <div class="product__pagination">
                        <div class="product__pagination">
                            <?= LinkPager::widget([
                                'pagination' => $dataProvider->pagination,
                                'nextPageLabel' => 'Next',
                                'prevPageLabel' => 'Previous',
                                'maxButtonCount' => 5,
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Product Section End -->