<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \common\models\SignupFormUserProfile $userprofile */
/** @var \common\models\SignupFormUser $user */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="userprofile-form">
    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'row g-3'],
    ]); ?>

    <div class="col-md-6">
        <?= $form->field($user, 'username')->textInput([
            'class' => 'form-control form-control-lg',
            'placeholder' => 'Enter your username'
        ]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($user, 'password')->passwordInput([
            'value' => '',
            'class' => 'form-control form-control-lg',
            'placeholder' => 'Enter your password'
        ]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($user, 'email')->textInput([
            'class' => 'form-control form-control-lg',
            'placeholder' => 'Enter your email'
        ]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($userprofile, 'nif')->textInput([
            'maxlength' => true,
            'class' => 'form-control form-control-lg',
            'placeholder' => 'Enter your NIF'
        ]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($userprofile, 'morada')->textInput([
            'maxlength' => true,
            'class' => 'form-control form-control-lg',
            'placeholder' => 'Enter your address'
        ]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($userprofile, 'morada2')->textInput([
            'maxlength' => true,
            'class' => 'form-control form-control-lg',
            'placeholder' => 'Enter a second address (optional)'
        ]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($userprofile, 'codigoPostal')->textInput([
            'maxlength' => true,
            'class' => 'form-control form-control-lg',
            'placeholder' => 'Enter postal code'
        ]) ?>
    </div>

    <div class="col-12 text-center">
        <?= Html::submitButton('Salvar', ['class' => 'site-btn btn-lg px-5 py-3 w-100']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
