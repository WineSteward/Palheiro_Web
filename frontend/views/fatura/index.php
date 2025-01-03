<?php

use common\helpers\UrlHelper;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $faturas common\models\Fatura[] */

$this->title = 'Faturas';
?>
<div class="faturas-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <?php foreach ($faturas as $fatura): ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="<?= Url::to(['fatura/view', 'id' => $fatura->id]) ?>" style="text-decoration: none; color: inherit;">
                    <div class="card">
                        <!-- Image Section -->
                        <div class="image-section" style="text-align: center; padding: 10px;">
                            <?= Html::img(UrlHelper::getCompanyImageUrl('palheiroLogo.png'), ['alt' => 'Imagem do logo da loja', 'style' => 'max-width: 100%; height: auto;']) ?>
                        </div>
                        <!-- Information Section -->
                        <div class="info-section" style="background-color: #28a745; padding: 8px; text-align: center;">
                            <p style="margin: 0; font-size: 14px;"><strong>Total: <?= Html::encode($fatura->total) ?>€</strong></p>
                            <p style="margin: 0; font-size: 12px;">Data: <?= Html::encode(Yii::$app->formatter->asDate($fatura->dataVenda, 'php:d/m/Y')) ?></p>
                            <p style="margin: 0; font-size: 12px;">Nº: <?= Html::encode($fatura->id) ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
