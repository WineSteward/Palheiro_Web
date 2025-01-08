<?php

use common\models\Fatura;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\FaturaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Faturas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fatura-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'label' => 'Nº Fatura',
            ],
            [
                'attribute' => 'userprofile_id',
                'label' => 'Identificação Cliente',
            ],
            'dataVenda',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Fatura $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        if (Yii::$app->user->isAdmin)
                        {
                            return Html::a('<i class="fas fa-trash"></i>', $url, [
                                'title' => Yii::t('app', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Deseja eliminar o fatura selecionada?'),
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
