<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Fatura $fatura */

$this->title = $fatura->id;
\yii\web\YiiAsset::register($this);
?>
<div class="fatura-view">

    <?= DetailView::widget([
        'model' => $fatura,
        'attributes' => [
            'id',
            'total',
            'dataVenda',
            'valida',
            'estadoEncomenda',
            'desconto_id',
            'userprofile_id',
            'metodoexpedicao_id',
            'metodopagamento_id',
        ],
    ]) ?>

</div>
