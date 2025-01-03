<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Mensagem $model */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Mensagens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mensagem-view">

    <p>
    <?php if(Yii::$app->user->isAdmin)
        {
            echo Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
        } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'titulo',
            'corpo:ntext',
            'email:email',
            'nome',
        ],
    ]) ?>

</div>
