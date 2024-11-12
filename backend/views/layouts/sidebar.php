<?php

use common\models\User;

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
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Gestão', 'header' => true],
                    ['label' => 'Produtos',  'icon' => 'th', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Categorias',  'icon' => 'th', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Ivas',  'icon' => 'th', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Marcas',  'icon' => 'th', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Métodos de Pagamento',  'icon' => 'th', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Métodos de Expedição',  'icon' => 'th', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Cupões',  'icon' => 'th', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Contabilidade', 'header' => true],
                    ['label' => 'Faturas',  'icon' => 'th', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Encomendas',  'icon' => 'th', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Utilizadores', 'header' => true],
                    ['label' => 'Clientes',  'icon' => 'th', 'url' => ['/gii'], 'target' => '_blank', 'visible' => User::asRole('admin')],
                    ['label' => 'Funcionários',  'icon' => 'th', 'url' => ['/gii'], 'target' => '_blank', 'visible' => User::asRole('admin')],
                    ['label' => 'Administradores',  'icon' => 'th', 'url' => ['/gii'], 'target' => '_blank', 'visible' => User::asRole('admin')],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>