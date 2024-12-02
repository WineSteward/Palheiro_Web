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
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja eliminar este cliente permanentemente?',
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
                'visible' => $model->morada2 != '', // Se a 2ª morada estiver vazia nao é apresentada
            ],
            'codigoPostal',
            [
                'label' => 'Username',
                'value' => function ($model) {
                    return $model->user->username;
                },
            ],
            'carrinho_id',
        ],
    ]) ?>

</div>
