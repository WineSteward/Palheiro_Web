<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Tarefa $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tarefa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= Html::encode('Feito:') ?>

    <?= $form->field($model, 'feito')->dropDownList(
        [
            '0' => 'False',
            '1' => 'True',
            ]
    )->label(false) ?>

    <br>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
