<?php

use common\models\User;
use yii\helpers\Url;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?=$assetDir?>/img/logo.png" alt="Palheiro Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Palheiro</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= Yii::$app->user->identity->username; ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

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
                    ['label' => 'Cupões',  'icon' => 'th', 'url' => Url::to(['cupao/index']),'visible' => Yii::$app->user->isAdmin],
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