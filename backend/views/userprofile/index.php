<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="flex d-flex mx-3">
        <p class="mr-5">
            <?= Html::a('Criar Cliente', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'email',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    if ($model->userprofile != null)
                        return Url::toRoute([$action, 'id' => $model->userprofile->id]);
                },
                'buttons' => [
                'cupoes-button' => function ($url, $model, $key) {
                    return Html::a('<i class="fas fa-info-circle">Cupões do Cliente</i>', [Url::to('userdesconto/index'), 'id' => $model->userprofile->id], [
                        'title' => Yii::t('app', 'Custom Action'),
                        'class' => 'btn btn-sm btn-info',
                    ]);
                },
                'tarefas-button' => function ($url, $model, $key) {
                    return Html::a('<i class="fas fa-info-circle">Tarefas Cliente</i>', [Url::to('tarefa/index'), 'id' => $model->userprofile->id], [
                        'title' => Yii::t('app', 'Custom Action'),
                        'class' => 'btn btn-sm btn-info',
                    ]);
                },

            ],
            'template' => '{view} {update} {delete} {cupoes-button} {tarefas-button}',
            ],
        ],
    ]); ?>


</div>