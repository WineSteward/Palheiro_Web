<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SignFormUser $model */

$this->title = 'Criar Pessoal Administrativo';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
