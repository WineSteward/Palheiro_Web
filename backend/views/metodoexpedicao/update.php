<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Metodoexpedicao $model */

$this->title = 'Editar Método de Expedição';
$this->params['breadcrumbs'][] = ['label' => 'Métodos de Expedição', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar Método';
?>
<div class="metodoexpedicao-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
