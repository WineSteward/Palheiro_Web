<?php

use common\helpers\UrlHelper;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                        <tr>
                            <th class="shoping__product">Produtos</th>
                            <th>Preço Unitário</th>
                            <th>Quantidade</th>
                            <th>Total da Linha</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($linhascarrinhos as $linhacarrinho): ?>
                            <tr>
                                <td class="shoping__cart__item">
                                    <?= Html::img(UrlHelper::getProductImageUrl($linhacarrinho->produto->imagens[0]->ficheiro) , ['style' => 'width: 150px; height: 100px;']) ?>
                                    <h5><?= Html::encode($linhacarrinho->produto->nome) ?></h5>
                                </td>
                                <td class="shoping__cart__price">
                                    <?= Html::encode($linhacarrinho->precoUnitario) ?>€
                                </td>
                                <td class="shoping__cart__quantity">
                                    <?= Html::beginForm(['linhacarrinho/update-quantity'], 'post', ['id' => 'form-id-'.$linhacarrinho->produto->id]) ?>
                                    <?= Html::hiddenInput('linha_id', $linhacarrinho->id) ?>
                                    <input type="number" name="quantidade" value="<?= $linhacarrinho->quantidade ?>" min="1" class="form-control">
                                    <?= Html::endForm() ?>
                                </td>
                                <td class="shoping__cart__total">
                                    <?= Html::encode($linhacarrinho->total) ?>€
                                </td>
                                <td class="shoping__cart__item__close">
                                    <?= Html::a(
                                        '<i class="fa-solid fa-xmark"></i>',
                                        ['linhacarrinho/delete', 'id' => $linhacarrinho->id],
                                        [
                                            'class' => 'btn btn-danger',
                                            'data-method' => 'post',
                                            'data-confirm' => 'Deseja retirar este produto do seu carrinho?',
                                        ]
                                    ) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Total do carrinho</h5>
                    <ul>
                        <li>Total:<span><?= Html::encode($carrinho->total) ?>€</span></li>
                    </ul>
                    <a href="<?=Url::to(['carrinho/metodos'])?>" class="primary-btn">Ir para Checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
