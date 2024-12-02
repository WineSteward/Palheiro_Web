<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Fatura $model */

$this->title = 'Gestão Fatura: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Faturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Estado Fatura';
?>

<div class="fatura-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
