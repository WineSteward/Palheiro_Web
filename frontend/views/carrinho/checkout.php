<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var $carrinho common\models\Carrinho 
 *  @var $metodoExpedicao common\models\Metodoexpedicao
 *  @var $metodoPagamento common\models\Metodopagamento
 */

?>

<div class="container py-5">
    <!-- Page Header -->
    <div class="text-center mb-5">
        <h1 class="display-4">Confirmação da Compra</h1>
        <p class="lead">Confira os detalhes abaixo antes de finalizar sua compra.</p>
    </div>

    <div class="mb-5" style=" border: 1px solid #93ba8d; border-radius: 5px;">
        <div class="card-header bg-success text-white d-flex align-items-center justify-content-center">
            <h4>Resumo</h4>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Método de Expedição:</strong> <?= Html::encode($metodoExpedicao->nome) ?></p>
                        <p><strong>Método de Pagamento:</strong> <?= Html::encode($metodoPagamento->nome) ?></p>
                    </div>
                </div>
            </div>

            <!-- Produtos do carrinho -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <tr>
                                <th class="shoping__product">Produtos</th>
                                <th>Preço Unitário</th>
                                <th>Quantidade</th>
                                <th>Subtotal</th>
                                <th>IVA (%)</th>
                                <th>Valor IVA</th>
                                <th>Total</th>
                            </tr>
                            <tbody>
                                <?php
                                $totalIva = 0;
                                foreach ($carrinho->linhascarrinhos as $linha): ?>
                                    <?php $totalIva += ($linha->produto->iva->valorPorcentagem / 100) * $linha->total; ?>
                                    <tr>
                                        <td><?= Html::encode($linha->produto->nome) ?></td>
                                        <td><?= Html::encode($linha->precoUnitario) ?>€</td>
                                        <td><?= Html::encode($linha->quantidade) ?></td>
                                        <td><?= Html::encode($linha->total - (($linha->produto->iva->valorPorcentagem / 100) * $linha->total)) ?>€</td>
                                        <td><?= Html::encode($linha->produto->iva->valorPorcentagem) ?>%</td>
                                        <td><?= Html::encode(($linha->produto->iva->valorPorcentagem / 100) * $linha->total) ?>€</td>
                                        <td><?= Html::encode($linha->total) ?>€</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- desconto e totais -->
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="shoping__discount">
                        <h5>Código de Desconto</h5>
                        <form action="<?= Url::to(['carrinho/desconto']) ?>" method="post">

                            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                            <div class="d-flex align-items-center">
                                <input type="text" name="discountCode" class="form-control me-2" placeholder="Insira o código de desconto" required>
                                <button type="submit" style="font-size:large; font-weight:bold;" class="btn btn-success">Aplicar</button>
                            </div>

                        </form>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout card">
                        <h5>Total do seu Carrinho</h5>
                        <ul>
                            <li>Total IVA <span><?= Html::encode($totalIva) ?>€</span></li>
                            <?php if ($placeholderTotal !== null): ?>
                                <li>Total Desconto <span><?= Html::encode($carrinho->total - $placeholderTotal) ?>€</span></li>
                            <?php endif ?>
                            <li>Total Geral<span><?= Html::encode($placeholderTotal !== null ? $placeholderTotal : $carrinho->total) ?>€</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-12 text-end">
                    <form action="<?= Url::to(['fatura/create']) ?>" method="post">
                        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>

                        <button type="submit" class="btn btn-success btn-lg" id="btn-comprar">Finalizar Compra</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>