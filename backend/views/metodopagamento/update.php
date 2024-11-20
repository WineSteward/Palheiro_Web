<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Metodopagamento $model */

$this->title = 'Editar Método de Pagamento';
$this->params['breadcrumbs'][] = ['label' => 'Métodos Pagamento', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="metodopagamento-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
