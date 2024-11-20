<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Valornutricional $model */

$this->title = 'Criar Valor Nutricional';
$this->params['breadcrumbs'][] = ['label' => 'Valornutricionals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="valornutricional-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
