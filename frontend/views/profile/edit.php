<?php
/** @var $user common\models\User */
/** @var $userProfile common\models\UserProfile */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Edit Profile';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-dark text-white text-center">
                    <h3 class="mt-3 mb-0"><?= Html::encode($user->username) ?></h3>
                    <p class="text-muted mb-2">Editar os teus dados pessoais</p>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin([
                        'id' => 'profile-edit-form',
                        'options' => ['class' => 'needs-validation', 'novalidate' => true],
                        'method' => 'post',
                        'action' => ['profile/update'],
                    ]); ?>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <?= Html::textInput('email', $user->email, ['class' => 'form-control', 'readonly' => true]) ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <?= $form->field($userProfile,  'morada')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $form->field($userProfile, 'morada2')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nif" class="form-label">NIF</label>
                            <?= Html::textInput('nif', $userProfile->nif, ['class' => 'form-control', 'readonly' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $form->field($userProfile, 'codigoPostal')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="created_at" class="form-label">Data de Criação</label>
                            <?= Html::textInput('created_at', Yii::$app->formatter->asDate($user->created_at, 'long'), ['class' => 'form-control', 'readonly' => true]) ?>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col text-center">
                            <?= Html::submitButton('Guardar', ['class' => 'site-btn']) ?>
                            <?= Html::a('Cancelar', ['profile/index'], ['class' => 'site-danger-btn']) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
