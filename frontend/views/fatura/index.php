<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var $fatura common\models\Fatura */
/** @var $linhasFatura common\models\LinhaFatura[] */
?>

<div class="container py-5">
    <!-- Page Header -->
    <div class="text-center mb-5">
        <h1 class="display-4">Confirmação da Compra</h1>
        <p class="lead">Confira os detalhes abaixo antes de finalizar sua compra.</p>
    </div>

    <!-- Fatura -->
    <div class="card mb-5">
        <div class="card-header bg-success text-white">
            <h4>Resumo e Produtos da Fatura</h4>
        </div>
        <div class="card-body">
            <!-- Informação da fatura -->
            <div class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Data de Criação:</strong> <?= Html::encode($fatura->dataVenda) ?></p>
                        <p><strong>Estado da Encomenda:</strong> <?= $fatura->estadoEncomenda == 0 ? 'Pendente' : 'Finalizado' ?></p>
                        <p><strong>Estado da Fatura:</strong> <?= $fatura->valida == 0 ? 'Por Finalizar' : 'Validado' ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Método de Expedição:</strong> <?= Html::encode($fatura->metodoexpedicao->nome) ?></p>
                        <p><strong>Método de Pagamento:</strong> <?= Html::encode($fatura->metodopagamento->nome) ?></p>
                    </div>
                </div>
            </div>

            <!-- Produtos da fatura -->
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
                            foreach ($fatura->linhasfatura as $linha):
                                $totalIva += $linha->valorIva;
                                ?>
                                <tr>
                                    <td><?= Html::encode($linha->produto->nome) ?></td>
                                    <td><?= Html::encode($linha->valorUnitario) ?>€</td>
                                    <td><?= Html::encode($linha->quantidade) ?></td>
                                    <td><?= Html::encode($linha->subtotal) ?>€</td>
                                    <td><?= Html::encode($linha->porcentagemIva) ?>%</td>
                                    <td><?= Html::encode($linha->valorIva) ?>€</td>
                                    <td><?= Html::encode($linha->total) ?>€</td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- desonto e totais -->
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="shoping__discount">
                        <h5>Código de Desconto</h5>
                        <form action="<?= Url::to(['fatura/desconto']) ?>" method="post">
                            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                            <input type="hidden" name="faturaId" value="<?= Html::encode($fatura->id) ?>">
                            <div class="d-flex">
                                <input type="text" name="discountCode" class="form-control me-2" placeholder="Insira o código de desconto" required>
                                <button type="submit" class="btn btn-success">Aplicar</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Total da Fatura</h5>
                        <ul>
                            <li>Total IVA <span><?= Html::encode($totalIva) ?>€</span></li>
                            <li>Total Geral <span><?= Html::encode($fatura->total) ?>€</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Finalizar -->
            <div class="row mt-4">
                <div class="col-lg-12 text-end">
                    <a href="<?= Url::to(['fatura/finalizar', 'id' => $fatura->id]) ?>" class="btn btn-success btn-lg">
                        Finalizar Compra
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
