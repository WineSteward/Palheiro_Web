<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var common\models\Userprofile $profile */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'password')->passwordInput(['value' => '']) ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'auth_key')->hiddenInput(['value' => ''])->label(false) ?>

    <?= $form->field($model, 'verification_token')->hiddenInput(['value' => ''])->label(false) ?>

    <?= '<div class="form-group">' ?>
        <?= Html::label('Escolha a role do utilizador a criar', 'role', ['class' => 'control-label']) ?>
        <?= Html::dropDownList('role', 'employee', [
            'employee' => 'Funcionário',
            'admin' => 'Administrador',
        ], 
        [
            'class' => 'form-control',
            'name' => 'role'
        ])?>
        <?= '</div>'?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>