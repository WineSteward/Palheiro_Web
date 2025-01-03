<?php

use common\models\Mensagem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mensagens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensagem-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'titulo',
            'corpo:ntext',
            'email:email',
            'nome',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Mensagem $model, $key, $index, $column) {
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
                'template' => '{delete} {view}',
            ],
        ],
    ]); ?>


</div>
