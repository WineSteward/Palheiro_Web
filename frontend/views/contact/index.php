<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contactos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Se tiver qualquer questão, por favor preencha o formulário em baixo. Obrigado
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

            <?php if(Yii::$app->user->isGuest): ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>
            
            <?php else: ?>

                <?= $form->field($model, 'name')
                            ->hiddenInput(['autofocus' => true, 'value' => Yii::$app->user->identity->username])
                            ->label(false) ?>

                <?= $form->field($model, 'email')
                            ->hiddenInput(['value' => Yii::$app->user->identity->email])
                            ->label(false) ?>

            <?php endif ?>
            
                <?= $form->field($model, 'subject')->label('Título') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6])->label('Mensagem') ?>
            
                <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
