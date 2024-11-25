<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Produto $model */
/** @var yii\helpers\ArrayHelper $categorias */
/** @var yii\helpers\ArrayHelper $ivas */
/** @var yii\helpers\ArrayHelper $marcas */
/** @var yii\helpers\ArrayHelper $valoresnutricionais */

$this->title = 'Criar Produto';
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-create">

    <?= $this->render('_form', [
        'model' => $model,
        'categorias' => $categorias,
        'ivas' => $ivas,
        'marcas' => $marcas,
        'valoresnutricionais' => $valoresnutricionais
    ]) ?>

</div>
