<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Userdesconto $model */

$this->title = 'Update Userdesconto: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Userdescontos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="userdesconto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
