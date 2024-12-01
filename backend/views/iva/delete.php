<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\IvaDeleteForm $model */
/** @var backend\models\Iva[] $ivas */

$this->title = 'Substituição do IVA';
$this->params['breadcrumbs'][] = ['label' => 'Ivas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Iva ' . $iva->valorPorcentagem . '%', 'url' => ['view', 'id' => $iva->id]];
$this->params['breadcrumbs'][] = 'Substituir Iva';
?>
<div class="iva-delete">

    <?= $this->render('_form-delete', [
        'model' => $model,
        'ivas' => $ivas,
    ]) ?>

</div>