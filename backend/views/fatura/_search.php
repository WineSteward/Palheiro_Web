<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\FaturaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="fatura-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'total') ?>

    <?= $form->field($model, 'dataVenda') ?>

    <?= $form->field($model, 'valida') ?>

    <?= $form->field($model, 'estadoEncomenda') ?>

    <?php // echo $form->field($model, 'desconto_id') ?>

    <?php // echo $form->field($model, 'userprofile_id') ?>

    <?php // echo $form->field($model, 'metodoexpedicao_id') ?>

    <?php // echo $form->field($model, 'metodopagamento_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
