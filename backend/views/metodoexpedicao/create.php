<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Metodoexpedicao $model */

$this->title = 'Criar Método de Expedição';
$this->params['breadcrumbs'][] = ['label' => 'Métodos de Expedição', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metodoexpedicao-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
