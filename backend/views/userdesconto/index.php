<?php

use common\models\Userdesconto;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Userdescontosearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cupões do Cliente' ;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userdesconto-index">

    <p>
        <?= Html::a('Adicionar Cupão ao Cliente', ['create', 'id' => $id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'valido',
                'label' => 'Válido',
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
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Userdesconto $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
