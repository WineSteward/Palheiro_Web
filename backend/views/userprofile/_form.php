<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Userprofile $userprofile */
/** @var common\models\User $user */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="userprofile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'ID')->hiddenInput(['value' => ''])->label(false) ?>

    <?= $form->field($user, 'username')->textInput() ?>

    <?= $form->field($user, 'password')->passwordInput(['value'=> '']) ?>

    <?= $form->field($user, 'email')->textInput() ?>

    <?= $form->field($userprofile, 'nif')->textInput() ?>

    <?= $form->field($userprofile, 'morada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($userprofile, 'morada2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($userprofile, 'codigoPostal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($userprofile, 'user_id')->hiddenInput(['value' => ''])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
