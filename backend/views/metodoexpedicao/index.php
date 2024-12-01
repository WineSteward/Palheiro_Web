<?php

use common\models\Metodoexpedicao;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\MetodoexpedicaoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Métodos de Expedição';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metodoexpedicao-index">

    <p>
        <?= Html::a('Criar Método de Expedição', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nome',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Metodoexpedicao $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        if (Yii::$app->user->isAdmin) {
                            return Html::a('<i class="fas fa-trash"></i>', $url, [
                                'title' => Yii::t('app', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Deseja eliminar o produto selecionado?'),
                                'data-method' => 'post',
                            ]);
                        }
                    },
                ],
                'template' => '{delete} {update} {view}',
            ],
        ],
    ]); ?>


</div>