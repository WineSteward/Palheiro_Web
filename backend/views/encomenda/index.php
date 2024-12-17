<?php

use common\models\Fatura;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Encomendas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fatura-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'dataVenda',
            [
                'attribute' => 'userprofile_id',
                'label' => 'Identificação do Cliente',
                'value' => function($model) {
                    return $model->userprofile->id;
                }
            ],
            [
                'attribute' => 'estadoEncomenda',
                'label' => 'Estado da Encomenda',
                'value' => function($model) 
                {
                    return $model->estadoEncomenda == 1 ? 'Pronta' : 'A ser preparada';
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Fatura $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
