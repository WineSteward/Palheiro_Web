<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Produto $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="produto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preco')->textInput()->label('Preço sem IVA') ?>

    <?= $form->field($model, 'descricao')->label('Descrição')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoria_id')->dropDownList($categorias, [
        'prompt' => 'Selecione uma categoria'])->label('Categoria');?>

    <?= $form->field($model, 'iva_id')->dropDownList($ivas, [
        'prompt' => 'Selecione um IVA'])->label('Ivas');?>

    <?= $form->field($model, 'marca_id')->dropDownList($marcas, [
            'prompt' => 'Selecione uma Marca'])->label('Marcas');?>

    <?= $form->field($model, 'valornutricional_id')->dropDownList($valoresnutricionais, [
            'prompt' => 'Selecione um Valor Nutricional'])->label('Valores Nutricionais');?>

    <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <div class="form-group">
        <?= Html::submitButton('Criar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
