<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Userdesconto $model */



$this->title = 'Detalhes do Desconto do Cliente';
$this->params['breadcrumbs'][] = ['label' => 'Descontos Do Cliente', 'url' => ['index', 'id' => $model->userprofile_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="userdesconto-view">

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            [
                'attribute' => 'valido',
                'label' => 'Validez',
                'value' => function($model){

                    return $model->valido == 1 ? 'Válido' : 'Não Válido';
                }
            ],
            [
                'attribute' => 'desconto_id',
                'label' => 'Desconto',
                'value' => function($model) {

                    return $model->desconto->nome;
                }
            ],
            [
                'attribute' => 'userprofile_id',
                'label' => 'Cliente',
                'value' => function($model) {

                    return $model->userprofile->user->username;
                }
            ],
        ],
    ]) ?>

</div>
