<?php
/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<form action="<?= Url::to(['fatura/metodos']) ?>" method="post">
    <?= Html::csrfMetaTags() ?> <!-- This ensures the CSRF token is included -->
    <h3>Selecione o metodo de expedição</h3>
    <?php foreach ($metodosexpedicao as $metodoexp): ?>
        <label>
            <input type="radio" name="metodoExpedicaoId" value="<?= $metodoexp->id ?>" required>
            <?= Html::encode($metodoexp->nome) ?>
        </label>
    <?php endforeach; ?>

    <h3>Selecione o metodo de pagamento</h3>
    <?php foreach ($metodospagamento as $metodopaga): ?>
        <label>
            <input type="radio" name="metodoPagamentoId" value="<?= $metodopaga->id ?>" required>
            <?= Html::encode($metodopaga->nome) ?>
        </label>
    <?php endforeach; ?>
    <br>
    <button type="submit" class="primary-btn">Continuar</button>
</form>
