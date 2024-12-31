<?php

use common\helpers\UrlHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \common\models\SignupFormUserProfile $userprofile */
/** @var \common\models\SignupFormUser $user */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="userprofile-form container mt-5 d-flex justify-content-center" style="background-size: cover; background-position: center; background-image: url('<?= UrlHelper::getCompanyImageUrl('fruitsalad.jpg') ?>');">
<div class="form-wrapper bg-light p-5 rounded shadow-lg" style="max-width: 400px; width: 100%; padding-top: 30px; padding-bottom: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
               <h2 class="text-center mb-4">Signup</h2>

        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "<div class=\"form-group\">
                                <label class=\"form-label\">{label}</label>
                                <div>{input}\n{error}</div>
                               </div>",
                'labelOptions' => ['class' => 'form-label'],
            ],
        ]); ?>

        <?= $form->field($user, 'username')->textInput([
            'placeholder' => 'Digite o username que deseja',
            'class' => 'form-control',
            'style' => 'width: 100%;'
        ]) ?>

        <?= $form->field($user, 'password')->passwordInput([
            'placeholder' => 'Indique uma password',
            'class' => 'form-control',
            'style' => 'width: 100%;'
        ]) ?>

        <?= $form->field($user, 'email')->textInput([
            'placeholder' => 'Indique o seu email',
            'class' => 'form-control',
            'style' => 'width: 100%;'
        ]) ?>

        <?= $form->field($userprofile, 'nif')->textInput([
            'maxlength' => true,
            'placeholder' => 'Indique o seu NIF',
            'class' => 'form-control',
            'style' => 'width: 100%;'
        ])->label('NIF') ?>

        <?= $form->field($userprofile, 'morada')->textInput([
            'maxlength' => true,
            'placeholder' => 'Indique a sua morada',
            'class' => 'form-control',
            'style' => 'width: 100%;'
        ]) ?>

        <?= $form->field($userprofile, 'morada2')->textInput([
            'maxlength' => true,
            'placeholder' => 'Detalhes adicionais de morada',
            'class' => 'form-control',
            'style' => 'width: 100%;'
        ]) ?>

        <?= $form->field($userprofile, 'codigoPostal')->textInput([
            'maxlength' => true,
            'placeholder' => 'Indique o seu código postal',
            'class' => 'form-control',
            'style' => 'width: 100%;'
        ]) ?>

        <div class="form-group text-center mt-3">
            <?= Html::submitButton('Sign Up', [
                'class' => 'btn btn-lg w-100',
                'style' => 'background-color: rgb(8, 106, 39); border-color: rgb(8, 106, 39); color: white;'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>