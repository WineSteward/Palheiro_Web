<?php

use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\SignupFormUserProfile $userprofile */
/** @var backend\models\SignupFormUser $user */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="userprofile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'username')->textInput() ?>

    <?= $form->field($user, 'password')->passwordInput(['value' => '']) ?>

    <?= $form->field($user, 'email')->textInput() ?>

    <?= $form->field($userprofile, 'nif')->textInput(['maxlength' => true]) ?>

    <?= $form->field($userprofile, 'morada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($userprofile, 'morada2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($userprofile, 'codigoPostal')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>