<?php

use common\helpers\UrlHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Produto $model */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="produto-view">

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nome',
            [
                'attribute' => 'preco',
                'label' => 'Preço s/IVA',
            ],
            [
                'attribute' => 'descricao',
                'label' => 'Descrição',
            ],
            [
                'attribute' => 'categoria_id',
                'label' => 'Categoria',
                'value' => function ($model) {
                    return $model->categoria->nome ?? '(Not Set)';
                },
            ],
            [
                'attribute' => 'iva_id',
                'label' => 'IVA',
                'value' => function ($model) {
                    return $model->iva->valorPorcentagem ?? '(Not Set)';
                },
            ],
            [
                'attribute' => 'marca_id',
                'label' => 'Marca',
                'value' => function ($model) {
                    return $model->marca->nome ?? '(Not Set)';
                },
            ],
            [
                'attribute' => 'valornutricional_id',
                'label' => 'Valor Nutricional',
                'value' => function ($model) {
                    return $model->valornutricional->nome ?? '(Not Set)';
                },
            ],
        ],
    ])
    ?>

    <h3>Imagens</h3>

    <div class="row">
        <?php foreach ($model->imagens as $imagem): ?>
            <div class="col-md-3 col-sm-4 col-6 text-center mb-4">
                <div class="image-wrapper">
                    <?= Html::img(UrlHelper::getProductImageUrl($imagem->ficheiro), ['class' => "img-thumbnail"]) ?>

                    <?= \yii\helpers\Html::a('Delete', ['image/deleteimage', 'id' => $imagem->id, 'imageName' => $imagem->ficheiro], [
                        'class' => 'btn btn-danger btn-sm mt-2',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this image?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>