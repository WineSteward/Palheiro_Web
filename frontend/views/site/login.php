<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use common\helpers\UrlHelper;

/** @var yii\web\View $this */
/** @var \common\models\LoginForm $model */

$this->title = 'Login';
?>

<div class="site-login container mt-5 d-flex justify-content-center" style="background-size: cover; background-position: center; background-image: url('<?= UrlHelper::getCompanyImageUrl('fruitsalad.jpg') ?>'); padding: 50px 0;">
    <div class="form-wrapper bg-light p-5 rounded shadow-lg" style="max-width: 400px; width: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h2 class="text-center mb-4">Login</h2>

        <?php if (Yii::$app->session->hasFlash('forbidden')): ?>
            <div class="alert alert-danger alert-dismissable">
                <?= Yii::$app->session->getFlash('forbidden') ?>
            </div>
        <?php endif; ?>

        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal', 'id' => 'login-form'],
            'fieldConfig' => [
                'template' => "<div class=\"form-group\">\n" .
                              "<label class=\"form-label\">{label}</label>\n" .
                              "<div>{input}\n{error}</div>\n" .
                              "</div>",
                'labelOptions' => ['class' => 'form-label'],
            ],
        ]); ?>

        <?= $form->field($model, 'username')->textInput([
            'autofocus' => true,
            'placeholder' => 'Enter your username',
            'class' => 'form-control',
            'style' => 'width: 100%;'
        ]) ?>

        <?= $form->field($model, 'password')->passwordInput([
            'placeholder' => 'Enter your password',
            'class' => 'form-control',
            'style' => 'width: 100%;'
        ]) ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"form-check\">\n" .
                          "{input}\n{label}\n{error}\n" .
                          "</div>",
            'class' => 'form-check-input'
        ]) ?>

        <div class="form-group text-center mt-3">
            <?= Html::submitButton('Login', [
                'class' => 'btn btn-lg w-100',
                'style' => 'background-color: rgb(8, 106, 39); border-color: rgb(8, 106, 39); color: white;',
                'name' => 'login-button'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
