<?php

/** @var $user common\models\User */
/** @var $userProfile common\models\Userprofile */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Profile';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-dark text-white text-center">
                    <h3 class="mt-3 mb-0"><?= Html::encode($user->username) ?></h3>
                    <p class="text-muted mb-2"><?= Html::encode($user->email) ?></p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h5 class="strong">Email</h5>
                            <p><strong>Email:</strong> <?= Html::encode($user->email) ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="strong">Morada</h5>
                            <p><strong>Morada 1:</strong> <?= Html::encode($userProfile->morada) ?></p>
                            <p><strong>Morada 2:</strong><?= Html::encode($userProfile->morada2 ?: '<sem dados>') ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="strong">Informação adicional</h5>
                            <p><strong>NIF:</strong> <?= Html::encode($userProfile->nif) ?></p>
                            <p><strong>Código Postal:</strong> <?= Html::encode($userProfile->codigoPostal) ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="strong">Outros</h5>
                            <p><strong>Data de criação:</strong> <?= Html::encode(Yii::$app->formatter->asDate($user->created_at, 'long')) ?></p>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end bg-light">
                    <?= Html::a('Editar Perfil', ['profile/edit'], ['class' => 'site-btn']) ?>
                </div>
            </div>
            <!-- Tabs for Discounts and Invoices -->
            <div class="mt-4">
                <ul class="nav nav-tabs" id="profile-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="descontos-tab" data-bs-toggle="tab" href="#descontos" role="tab" aria-controls="descontos" aria-selected="true">Cupões</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="faturas-tab" data-bs-toggle="tab" href="#faturas" role="tab" aria-controls="faturas" aria-selected="false">Encomendas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tarefas-tab" data-bs-toggle="tab" href="#tarefas" role="tab" aria-controls="tarefas" aria-selected="false">Tarefas</a>
                    </li>
                </ul>
                <div class="tab-content" id="profile-tabs-content">
                    <!-- Descontos -->
                    <div class="tab-pane fade show active" id="descontos" role="tabpanel" aria-labelledby="descontos-tab">
                        <div class="card mt-3">
                            <div class="card-body">
                                <?php if (!empty($userDescontos)): ?>
                                    <ul>
                                        <?php foreach ($userDescontos as $userDesconto): ?>
                                            <li class="list-group-item">
                                                <strong><?= Html::encode($userDesconto->desconto->nome) ?>:</strong>
                                                <?= Html::encode($userDesconto->desconto->valor) ?>% no total da compra
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p>Sem descontos.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Encomendas -->
                    <div class="tab-pane fade" id="faturas" role="tabpanel" aria-labelledby="faturas-tab">
                        <div class="card mt-3">
                            <div class="card-body">
                                <?php if (!empty($encomendas)): ?>
                                    <ul class="list-group">
                                        <?php foreach ($encomendas as $encomenda): ?>
                                            <li class="list-group-item">
                                                <strong>Encomenda</strong>
                                                <span class="float-end"><?= Html::encode($encomenda->dataVenda) ?> | <?= $encomenda->estadoEncomenda == 0 ? Html::tag('span', 'Em preparação', ['style' => 'color: blue;']) : Html::tag('span', 'Entregue', ['style' => 'color: green;']) ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p class="text-muted">Sem Encomendas.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- Tarefas -->
                    <div class="tab-pane fade" id="tarefas" role="tabpanel" aria-labelledby="tarefas-tab">
                        <div class="card mt-3">
                            <div class="card-body">
                                <?php if (!empty($tarefas)): ?>
                                    <ul class="list-group">
                                        <?php foreach ($tarefas as $tarefa): ?>
                                            <a href="<?= Url::to(['tarefa/view', 'id' => $tarefa->id]) ?>"><li class="list-group-item">
                                                <strong>Tarefa</strong>
                                                <span class="float-end" <?= $tarefa->feito == 0 ? Html::tag('span', 'Por Fazer', ['style' => 'color: blue;']) : Html::tag('span', 'Feita', ['style' => 'color: green;']) ?></span>
                                            </li>
                                            </a>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p class="text-muted">Sem Tarefas.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>