<?php

use common\models\User;
use yii\helpers\Url;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= Yii::getAlias('@web/company/logo.png') ?>" alt="Palheiro Logo" class="" style="opacity: .8; width:60px; height:60px ">
        <span class="brand-text font-weight-light">Palheiro</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">Utilizador: <?= Yii::$app->user->identity->username; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Gestão de Negócio', 'header' => true],
                    ['label' => 'Produtos',  'icon' => 'th', 'url' => Url::to(['produto/index'])],
                    ['label' => 'Categorias',  'icon' => 'th', 'url' => Url::to(['categoria/index'])],
                    ['label' => 'Ivas',  'icon' => 'th', 'url' => Url::to(['iva/index'])],
                    ['label' => 'Marcas',  'icon' => 'th', 'url' => Url::to(['marca/index'])],
                    ['label' => 'Valores Nutricionais',  'icon' => 'th', 'url' => Url::to(['valornutricional/index'])],
                    ['label' => 'Métodos de Pagamento',  'icon' => 'th', 'url' => Url::to(['metodopagamento/index'])],
                    ['label' => 'Métodos de Expedição',  'icon' => 'th', 'url' => Url::to(['metodoexpedicao/index'])],
                    ['label' => 'Cupões',  'icon' => 'th', 'url' => Url::to(['desconto/index']),'visible' => Yii::$app->user->isAdmin],
                    ['label' => 'Contabilidade e Encomendas', 'header' => true],
                    ['label' => 'Faturas',  'icon' => 'th', 'url' => Url::to(['fatura/index'])],
                    ['label' => 'Encomendas',  'icon' => 'th', 'url' => Url::to(['encomenda/index'])],
                    ['label' => 'Gestão de Utilizadores', 'header' => true,'visible' => Yii::$app->user->isAdmin],
                    ['label' => 'Clientes',  'icon' => 'th', 'url' => Url::to(['userprofile/index']),'visible' => Yii::$app->user->isAdmin],
                    ['label' => 'Administrativos',  'icon' => 'th', 'url' => Url::to(['user/index']),'visible' => Yii::$app->user->isAdmin],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>