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

    <p>
        <?= Html::a('Criar Cliente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'email',
            [
                'attribute' => 'userprofile.morada',
                'label' => 'Morada',
                'value' => function ($model) {
                    return $model->userprofile->morada ?? '(not set)';
                },
            ],
            [
                'attribute' => 'userprofile.morada2',
                'label' => '2ª Morada',
                'value' => function ($model) {
                    return $model->userprofile->morada2 ?? '(not set)';
                },
            ],
            [
                'attribute' => 'userprofile.nif',
                'label' => 'NIF',
                'value' => function ($model) {
                    return $model->userprofile->nif ?? '(not set)';
                },
            ],
            [
                'attribute' => 'userprofile.codigoPostal',
                'label' => 'Código Postal',
                'value' => function ($model) {
                    return $model->userprofile->codigoPostal ?? '(not set)';
                },
            ],
            //'status',
            //'created_at',
            //'updated_at',
            //'verification_token',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column)
                {
                    if($model->userprofile != null)
                        return Url::toRoute([$action, 'id' => $model->userprofile->id]);
                }
            ],
        ],
    ]); ?>


</div>
