<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Userprofile $model */

$this->title = $model->user->username;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="userprofile-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nif',
            'morada',
            [
                'label' => 'Morada2',
                'value' => $model->morada2,
                'visible' => $model->morada2 !== '', // Check if not an empty string
            ],
            'codigoPostal',
            [
                'label' => 'Username', // Custom label
                'value' => function ($model) {
                    return $model->user ? $model->user->username : null; // Access the related User model's attribute
                },
            ],
            'carrinho_id',
        ],
    ]) ?>

</div>
