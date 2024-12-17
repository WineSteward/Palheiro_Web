<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Userdesconto $model */

$this->title = 'Editar Desconto';
$this->params['breadcrumbs'][] = ['label' => 'Descontos do Cliente', 'url' => ['index', 'id' => $model->userprofile_id]];
$this->params['breadcrumbs'][] = ['label' => 'Detalhes do Desconto do Cliente', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar Desconto';
?>
<div class="userdesconto-update">

    <?= $this->render('_form', [
        'model' => $model,
        'descontos' => $descontos
    ]) ?>

</div>
