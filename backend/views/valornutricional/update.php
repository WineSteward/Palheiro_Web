<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Valornutricional $model */

$this->title = 'Editar Valor Nutricional';
$this->params['breadcrumbs'][] = ['label' => 'Valores Nutricionais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar Valor Nutricional';
?>
<div class="valornutricional-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
