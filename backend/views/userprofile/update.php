<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Userprofile $userprofile  */

$this->title = 'Editar Cliente';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $userprofile->user->username, 'url' => ['view', 'id' => $userprofile->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="userprofile-update">

    <?= $this->render('_form', [
        'userprofile' => $userprofile,
        'user' => $userprofile->user
    ]) ?>

</div>
