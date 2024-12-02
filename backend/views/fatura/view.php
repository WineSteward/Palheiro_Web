<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Fatura $model */

$this->title = 'Nº Fatura: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Faturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fatura-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'total',
            [
                'attribute' => 'total',
                'label' => 'Total da Fatura',
            ],
            [
                'attribute' => 'dataVenda',
                'label' => 'Data da Fatura',
            ],
            [
                'attribute' => 'valida',
                'label' => 'Vigor',
                'value' => function ($model) {
                    return $model->valida == 1 ? 'Válida' : 'Não Válida';
                },
            ],
            //'desconto_id',
            [
                'attribute' => 'userprofile_id',
                'label' => 'Identificação Cliente',
            ],
            [
                'attribute' => 'metodoexpedicao_id',
                'label' => 'Método de Expedição',
                'value' => function ($model) {
                    return $model->metodoexpedicao->nome;
                },
            ],
            [
                'attribute' => 'metodopagamento_id',
                'label' => 'Método de Pagamento',
                'value' => function ($model) {
                    return $model->metodopagamento->nome;
                },
            ],
        ],
    ]) ?>

</div>
