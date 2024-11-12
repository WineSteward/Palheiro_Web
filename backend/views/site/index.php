<?php
$this->title = 'Starter Page';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-4">
        <?php $smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                'title' => '120',
                'text' => 'Total de Faturas de esta semana',
                'icon' => 'fas fa-shopping-cart',
                'theme' => 'success'
            ]) ?>
            <?= \hail812\adminlte\widgets\Ribbon::widget([
                'id' => $smallBox->id.'-ribbon',
                'text' => 'Ribbon',
                'theme' => 'warning',
                'size' => 'lg',
                'textSize' => 'lg'
            ]) ?>
            <?php \hail812\adminlte\widgets\SmallBox::end() ?>
        </div>
        <div class="col-lg-4">
        <?php $smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                'title' => '98',
                'text' => 'Encomendas a serem preparadas',
                'icon' => 'fas fa-shopping-cart',
                'theme' => 'warning',
            ]) ?>
            <?php \hail812\adminlte\widgets\SmallBox::end() ?>
        </div>
        <div class="col-lg-4">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Número de Produtos na Loja',
                'number' => '13,648',
                'theme' => 'gradient-warning',
                'icon' => 'far fa-copy',
            ]) ?>
        </div>
    </div>    

    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Messages',
                'number' => '1,410',
                'icon' => 'far fa-envelope',
            ]) ?>
        </div>

    </div>



</div>