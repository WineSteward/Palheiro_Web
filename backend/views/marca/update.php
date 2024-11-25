<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Marca $model */

$this->title = 'Atualizar Marca: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Marcas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar Marca';
?>
<div class="marca-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
