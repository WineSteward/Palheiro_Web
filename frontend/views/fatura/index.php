<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var $fatura common\models\Fatura */
/** @var $linhasFatura common\models\LinhaFatura[] */
?>

<div class="container py-5">
    <h1 class="text-center mb-4">Confirmação da Fatura</h1>

    <!-- Fatura Details -->
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Detalhes da Fatura</h4>
                </div>
                <div class="card-body">
                    <p><strong>Total:</strong> <?= Html::encode($fatura->total) ?>€</p>
                    <p><strong>Data de Criação:</strong> <?= Html::encode($fatura->dataVenda) ?></p>
                    <p><strong>Estado:</strong> <?= Html::encode($fatura->estadoEncomenda) ?></p>
                    <p><strong>Método de Expedição:</strong> <?= Html::encode($fatura->metodoexpedicao->nome) ?></p>
                    <p><strong>Método de Pagamento:</strong> <?= Html::encode($fatura->metodopagamento->nome) ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Linha Fatura Table -->
    <div class="row mb-5">
        <div class="col-lg-10 mx-auto">
            <h3 class="mb-3">Produtos na Fatura</h3>
            <table class="table table-bordered">
                <thead class="table-dark">
                <tr>
                    <th>Produto</th>
                    <th>Preço Unitário</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                    <th>IVA (%)</th>
                    <th>Valor IVA</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($fatura->linhasfatura as $linha): ?>
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

    <!-- Discount Code Form -->
    <div class="row mb-5">
        <div class="col-lg-6">
            <div class="shoping__continue">
                <div class="shoping__discount">
                    <h5>Codigo de Desconto</h5>
                    <form action="<?= Url::to(['fatura/apply-discount', 'id' => $fatura->id]) ?>" method="post">
                        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                        <input type="text" name="discountCode" placeholder="Introluza o seu codigo de desconto" required>
                        <button type="submit" class="btn btn-primary mt-2">Aplicar Cupões</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Finalize Button -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <a href="<?= Url::to(['fatura/finalizar', 'id' => $fatura->id]) ?>" class="btn btn-success btn-lg">
                Finalizar Compra
            </a>
        </div>
    </div>
</div>
