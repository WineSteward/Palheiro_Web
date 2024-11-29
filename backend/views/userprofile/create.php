<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SignupFormUserProfile $userprofile */
/** @var backend\models\SignupFormUser $user */


$this->title = 'Criar Cliente';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userprofile-create">

    <?= $this->render('_form', [
        'userprofile' => $userprofile,
        'user' => $user
    ]) ?>

</div>
