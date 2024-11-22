<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Metodopagamento $model */

$this->title = 'Detalhes do Método de Pagmento';
$this->params['breadcrumbs'][] = ['label' => 'Métodos de Pagamento', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="metodopagamento-view">

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if(Yii::$app->user->isAdmin)
        {
            echo Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
        } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nome',
            [
                'attribute' => 'vigor',
                'value' => function ($model) {
                    return $model->vigor == 1 ? 'Válido' : 'Não Válido';
                },
            ],
        ],
    ]) ?>

</div>
