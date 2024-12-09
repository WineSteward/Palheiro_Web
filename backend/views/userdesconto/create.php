<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Userdesconto $model */
/** @var yii\helpers\ArrayHelper $descontos */

$this->title = 'Associar Desconto';
$this->params['breadcrumbs'][] = ['label' => 'Descontos', 'url' => ['index', 'id' => $id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userdesconto-create">

    <?= $this->render('_form', [
        'model' => $model,
        'descontos' => $descontos
    ]) ?>

</div>
