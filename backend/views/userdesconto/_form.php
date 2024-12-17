<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Userdesconto $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="userdesconto-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'desconto_id')->dropDownList($descontos, [
        'prompt' => 'Selecione um desconto'])->label('Descontos') ?>
    
    <?= $form->field($model, 'valido')->dropDownList(
        [
            '1' => 'Válido',
            '0' => 'Não Válido',
            ]
    )->label('Válidez') ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
