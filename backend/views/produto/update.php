<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Produto $model */
/** @var yii\helpers\ArrayHelper $categorias */
/** @var yii\helpers\ArrayHelper $ivas */
/** @var yii\helpers\ArrayHelper $marcas */
/** @var yii\helpers\ArrayHelper $valoresnutricionais */


$this->title = 'Editar Produto';
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar Produto';
?>
<div class="produto-update">

    <?= $this->render('_form', [
        'model' => $model,
        'categorias' => $categorias,
        'ivas' => $ivas,
        'marcas' => $marcas,
        'valoresnutricionais' => $valoresnutricionais
    ]) ?>

</div>
