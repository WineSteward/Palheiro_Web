<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php $form = ActiveForm::begin([
    'action' => Url::to(['fatura/metodos']),
    'method' => 'post',
]); ?>

<h3>Selecione o metodo de expedição</h3>
<?php foreach ($metodosexpedicao as $metodoexp): ?>
    <label>
        <?= Html::radio('metodoExpedicaoId', false, [
            'value' => $metodoexp->id,
            'required' => true,
        ]) ?>
        <?= Html::encode($metodoexp->nome) ?>
    </label>
<?php endforeach; ?>

<h3>Selecione o metodo de pagamento</h3>
<?php foreach ($metodospagamento as $metodopaga): ?>
    <label>
        <?= Html::radio('metodoPagamentoId', false, [
            'value' => $metodopaga->id,
            'required' => true,
        ]) ?>
        <?= Html::encode($metodopaga->nome) ?>
    </label>
<?php endforeach; ?>

<br>
<div class="form-group">
    <?= Html::submitButton('Continuar', ['class' => 'primary-btn']) ?>
</div>

<?php ActiveForm::end(); ?>
