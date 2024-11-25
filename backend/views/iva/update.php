<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Iva $model */

$this->title = 'Editar Iva';
$this->params['breadcrumbs'][] = ['label' => 'Ivas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Iva ' . $model->valorPorcentagem .'%' , 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar Iva';
?>
<div class="iva-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
