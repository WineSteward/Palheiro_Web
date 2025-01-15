<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Tarefa $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Perfil', 'url' => ['profile/index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tarefa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'descricao',
            [
                'attribute' => 'feito',
                'label' => 'Feito',
                'value' => function($model){

                    return $model->feito == 1 ? 'Feito' : 'Por fazer';
                }
            ],
        ],
    ]) ?>

</div>
