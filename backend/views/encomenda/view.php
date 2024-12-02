<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Fatura $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Faturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fatura-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar Estado da Encomenda', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'total',
            'dataVenda',
            [
                'attribute' => 'estadoEncomenda',
                'label' => 'Estado da Encomenda',
                'value' => function($model) 
                {
                    return $model->estadoEncomenda == 1 ? 'Pronta' : 'A ser preparada';
                }
            ],
            [
                'attribute' => 'metodopagamento_id',
                'label' => 'Identificação do Cliente',
                'value' => function($model) {
                    return $model->userprofile->nome;
                }
            ],
            [
                'attribute' => 'metodopagamento_id',
                'label' => 'Método de Expedição',
                'value' => function($model) {
                    return $model->metodoexpedicao->nome;
                }
            ],
            [
                'attribute' => 'metodopagamento_id',
                'label' => 'Método de Pagamento',
                'value' => function($model) {
                    return $model->metodopagamento->nome;
                }
            ],
            [
                'attribute' => 'userprofile_id',
                'label' => 'Identificação do Cliente',
                'value' => function($model) {
                    return $model->userprofile->id;
                }
            ],
        ],
    ]) ?>

</div>
