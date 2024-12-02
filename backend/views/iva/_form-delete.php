<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\IvaDeleteForm $model */
/** @var common\models\Ivas $ivas */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="iva-form">

    <h4>Todos os produtos que tenham o presente IVA vão ser alterados para o seguinte IVA:</h4>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'iva_id')->dropDownList($ivas, [
            'prompt' => 'Selecione o valor do IVA que pretende substituir pelo atual'])->label('IVAs');
    ?>

    <div class="form-group">
        <?= Html::submitButton('Substituir', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
