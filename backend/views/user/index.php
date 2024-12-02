<?php

use common\models\User;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Criar Pessoal Administrativo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <p>
        <?= Html::a('Criar Pessoal Administrativo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php if (Yii::$app->session->hasFlash('showModal')):

        // Create the modal
        Modal::begin([
            'id' => 'modal-id',
            'title' => '<h4 class="text-danger" >Avisa</h4>',
        ]);

        echo '<p>Não pode eliminar o último Administrador</p>';

        Modal::end();
       
        $this->registerJs("
        $(document).ready(function() {
            $('#modal-id').modal('show');
        });
    ");
    ?>
    
    <?php endif; ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            [
                'attribute' => 'role',
                'label' => 'Função',
                'value' => 'role',
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

</div>