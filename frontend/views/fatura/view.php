<?php

/** @var yii\web\View $this */
/** @var common\models\Fatura $fatura */

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Nº Fatura: ' . $fatura->id;
\yii\web\YiiAsset::register($this);


$totalIVA = 0;
$totalSubtotal = 0;
foreach ($fatura->linhasfatura as $linha) {
    if (!$linha->produto_id)
        continue;
    $totalIVA += $linha->valorIva;
    $totalSubtotal += $linha->subtotal;
}
$totalFatura = $totalSubtotal + $totalIVA;
?>

<div class="fatura-view">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    <p><strong>Data da Venda:</strong> <?= Yii::$app->formatter->asDate($fatura->dataVenda) ?></p>

    <div class="table-responsive">
        <table class="table table-bordered tabela-fatura">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Valor Unitário</th>
                    <th>Quantidade</th>
                    <th>IVA (%)</th>
                    <th>Valor IVA</th>
                    <th>Subtotal</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fatura->linhasfatura as $linha): ?>
                    <?php if ($linha->produto_id): ?>
                        <tr>
                            <td><?= Html::encode($linha->produto->nome) ?></td>
                            <td><?= Yii::$app->formatter->asCurrency($linha->valorUnitario) ?></td>
                            <td><?= $linha->quantidade ?></td>
                            <td><?= $linha->porcentagemIva ?>%</td>
                            <td><?= Yii::$app->formatter->asCurrency($linha->valorIva) ?></td>
                            <td><?= Yii::$app->formatter->asCurrency($linha->subtotal) ?></td>
                            <td><?= Yii::$app->formatter->asCurrency($linha->total) ?></td>
                        </tr>
                    <?php endif ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="totals-section">
        <table class="table table-bordered tabela-fatura" style="width: 40%; margin-left: auto;">
            <tbody>
                <?php if (!$fatura->desconto_id): ?>
                    <tr>
                        <th>Total Valor IVA:</th>
                        <td><?= Yii::$app->formatter->asCurrency($totalIVA) ?></td>
                    </tr>
                    <tr>
                        <th>Total Subtotal:</th>
                        <td><?= Yii::$app->formatter->asCurrency($totalSubtotal) ?></td>
                    </tr>
                    <tr>
                        <th>Total Fatura:</th>
                        <td><?= Yii::$app->formatter->asCurrency($fatura->total) ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <th>Total Valor IVA:</th>
                        <td><?= Yii::$app->formatter->asCurrency($totalIVA) ?></td>
                    </tr>
                    <tr>
                        <th>Total Subtotal:</th>
                        <td><?= Yii::$app->formatter->asCurrency($totalSubtotal) ?></td>
                    </tr>
                    <tr>
                        <th>Total Original:</th>
                        <td><?= Yii::$app->formatter->asCurrency($fatura->total + $fatura->linhasfatura[0]->total) ?></td>
                    </tr>
                    <tr>
                        <th>Total Desconto:</th>
                        <td style="font-weight: bold; color: #7fad39;"><?= '-' . Yii::$app->formatter->asCurrency($fatura->linhasfatura[0]->total) ?></td>
                    </tr>
                    <tr>
                        <th>Total Fatura:</th>
                        <td><?= Yii::$app->formatter->asCurrency($fatura->total) ?></td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>