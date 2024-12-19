<?php

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
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($linhascarrinhos as $linhacarrinho): ?>
                            <tr>
                                <td class="shoping__cart__item">
                                    <img src="" alt=""><!-- URLHelper::getProductImageUrl($linhacarrinho->produto->imagem->ficheiro)
                                    -->
                                    <h5><?= Html::encode($linhacarrinho->produto->nome) ?></h5>
                                </td>
                                <td class="shoping__cart__price">
                                    <?= Html::encode($linhacarrinho->precoUnitario) ?>€
                                </td>
                                <td class="shoping__cart__quantity">
                                    <?= Html::beginForm(['linhacarrinho/update-quantity'], 'post') ?>
                                    <?= Html::hiddenInput('linha_id', $linhacarrinho->id) ?>
                                    <input type="number" name="quantidade" value="<?= $linhacarrinho->quantidade ?>" min="1" class="form-control"><!--todo max quantidade em stock-->
                                    <?= Html::endForm() ?>
                                </td>
                                <td class="shoping__cart__total">
                                    <?= Html::encode($linhacarrinho->total) ?>€
                                </td>
                                <td class="shoping__cart__item__close">
                                    <?= Html::a(
                                        '<i class="fa-solid fa-xmark"></i>', // força o icon a funcionar
                                        ['linhacarrinho/delete', 'id' => $linhacarrinho->id],
                                        [
                                            'class' => 'btn btn-danger',
                                            'data-method' => 'post',
                                            'data-confirm' => 'Are you sure you want to remove this item?',
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
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="<?= Url::to(['produto/index']) ?>" class="primary-btn cart-btn">Continuar compras</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Total do carrinho</h5>
                    <ul>
                        <li>Total <span><?= Html::encode($carrinho->total) ?>€</span></li>
                    </ul>
                    <a href="<?=Url::to(['fatura/metodos'])?>" class="primary-btn">Ir para Checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
