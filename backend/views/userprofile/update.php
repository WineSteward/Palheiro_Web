<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Userprofile $model  */
/** @var common\models\User $user */

$this->title = 'Editar Cliente: ' . $userprofile->id;
$this->params['breadcrumbs'][] = ['label' => 'Userprofiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $userprofile->id, 'url' => ['view', 'id' => $userprofile->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="userprofile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'userprofile' => $userprofile,
        'user' => $user
    ]) ?>

</div>
