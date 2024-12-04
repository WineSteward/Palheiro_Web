<?php
$this->title = 'Starter Page';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-6">
            <?php $smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                'title' => $qtddProdutos,
                'text' => 'Quantidade de Produtos Únicos em Loja',
                'icon' => 'fas fa-shopping-cart',
                'theme' => 'success'
            ]) ?>
            <?php \hail812\adminlte\widgets\SmallBox::end() ?>
        </div>
        <div class="col-lg-6">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fa-bookmark"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Encomendas a serem preparadas:</span>
                    <span class="info-box-number"><?= ($qtddEncomendas - $qtddEncomendasPreparadas) ?></span>
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width: <?php
                        if($qtddEncomendas == 0)
                            echo '100';
                        
                        echo ($qtddEncomendasPreparadas/$qtddEncomendas)*100 ?? ''; 
                        
                        ?>%"></div>
                    </div>
                    <span class="progress-description">
                        Progressão das encomendas preparadas.
                    </span>
                </div>
            </div>
            <!-- <?php /*$smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                'title' => $qtddEncomendas,
                'text' => 'Encomendas a serem preparadas',
                'icon' => '',
                'theme' => 'warning',
            ]) ?> <?= \hail812\adminlte\widgets\Ribbon::widget([
                        'id' => $smallBox->id . '-ribbon',
                        'text' => 'Prioridade',
                        'theme' => 'danger',
                        'size' => 'lg',
                        'textSize' => 'md'
                    ]) ?>
            <?php \hail812\adminlte\widgets\SmallBox::end() */ ?> -->
        </div>

    </div>

    <div class="row">
        <div class="col-md-4 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Número de Produtos na Loja',
                'number' => '13,648',
                'theme' => 'gradient-warning',
                'icon' => 'far fa-copy',
            ]) ?>
        </div>
        <div class="col-md-4 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Número de Produtos na Loja',
                'number' => '13,648',
                'theme' => 'gradient-warning',
                'icon' => 'far fa-copy',
            ]) ?>
        </div>
        <div class="col-md-4 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Messages',
                'number' => '1,410',
                'icon' => 'far fa-envelope',
            ]) ?>
        </div>
    </div>
</div>



</div>