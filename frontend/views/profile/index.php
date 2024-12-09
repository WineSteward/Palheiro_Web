<?php
/** @var $user common\models\User */
/** @var $userProfile common\models\Userprofile */
use yii\helpers\Html;

$this->title = 'Profile';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-dark text-white text-center">
                    <div class="profile-image">
                        <img src="https://via.placeholder.com/100" alt="Profile Image" class="rounded-circle">
                    </div>
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
                            <p><strong>Morada 2:</strong> <?= Html::encode($userProfile->morada2) ?></p>
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
                            <p><strong>Joined On:</strong> <?= Html::encode(Yii::$app->formatter->asDate($user->created_at, 'long')) ?></p>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end bg-light">
                    <?= Html::a('Editar Profile', ['/user/edit-profile'], ['class' => 'site-btn']) ?>
                </div>
            </div>
            <!-- Tabs for Discounts and Invoices -->
            <div class="mt-4">
                <ul class="nav nav-tabs" id="profile-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="descontos-tab" data-bs-toggle="tab" href="#descontos" role="tab" aria-controls="descontos" aria-selected="true">Descontos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="faturas-tab" data-bs-toggle="tab" href="#faturas" role="tab" aria-controls="faturas" aria-selected="false">Faturas</a>
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
                                            <li>
                                                <strong><?= Html::encode($userDesconto->desconto->nome) ?>:</strong>
                                                <?= Html::encode($userDesconto->desconto->valor) ?>%
                                                <?= $userDesconto->valido ? '(Valido)' : '(Invalido)' ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p>Sem descontos.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Faturas -->
                    <div class="tab-pane fade" id="faturas" role="tabpanel" aria-labelledby="faturas-tab">
                        <div class="card mt-3">
                            <div class="card-body">
                                <?php if (!empty($faturas)): ?>
                                    <ul class="list-group">
                                        <?php foreach ($faturas as $fatura): ?>
                                            <li class="list-group-item">
                                                <strong>Invoice #<?= Html::encode($fatura->id) ?></strong>
                                                <span class="float-end"><?= Html::encode(Yii::$app->formatter->asDate($fatura->date, 'long')) ?> - <?= Html::encode($fatura->total) ?>€</span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p class="text-muted">Sem Faturas.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
