<div class="container-fluid">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-lg-6">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fa-bookmark"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Encomendas a serem preparadas:</span>
                    <span class="info-box-number"><?= ($qtddEncomendas - $qtddEncomendasPreparadas) ?></span>
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width:
                         <?php
                            if ($qtddEncomendas == 0)
                                echo '100';
                            else {
                                echo ($qtddEncomendasPreparadas / $qtddEncomendas) * 100 ?? '';
                            }
                            ?>%"></div>
                    </div>
                    <span class="progress-description">
                        Progressão das encomendas preparadas.
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Número de Produtos únicos em Loja',
                'number' => $qtddProdutos,
                'theme' => 'gradient-warning',
                'icon' => 'far fa-copy',
            ]) ?>
        </div>
        <div class="col-md-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Mensagens de Utilizadores pelos Contactos',
                'number' => $qtddMensagens,
                'icon' => 'far fa-envelope',
            ]) ?>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="row">
        <div class="col-md-6">
            <div class="chart-container" style="position: relative; height:300px; width:100%">
                <canvas id="faturasChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="chart-container" style="position: relative; height:300px; width:100%">
                <canvas id="totalFaturasChart"></canvas>
            </div>
        </div>
    </div>
    <!-- Pie Chart with Description -->
    <div class="row mt-4">
        <div class="col-12">
            <h5 class="text-center">Distribuição de Categorias/Fatura</h5>
            <p class="text-center text-muted">O gráfico abaixo representa a percentagem de cada categoria em média por fatura. Por outras palavras, quanto maior a % maior o nº de faturas que têm essa fatura na sua constituição.</p>
            <div class="chart-container" style="position: relative; height:300px; width:100%">
                <canvas id="categoriaChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Bar Chart
        const barCtx = document.getElementById('faturasChart').getContext('2d');
        const faturasChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($chartData['labels']) ?>,
                datasets: [{
                    label: 'Nº de faturas por Mês',
                    data: <?= json_encode($chartData['data']) ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Pie Chart
        const pieCtx = document.getElementById('categoriaChart').getContext('2d');
        const categoriaChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: <?= json_encode($pieChartData['labels']) ?>,
                datasets: [{
                    data: <?= json_encode($pieChartData['data']) ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });

         // Bar Chart for Total Faturas by Month
         const totalFaturasCtx = document.getElementById('totalFaturasChart').getContext('2d');
        const totalFaturasChart = new Chart(totalFaturasCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($totalFaturasChartData['labels']) ?>,
                datasets: [{
                    label: 'Total € por Mês',
                    data: <?= json_encode($totalFaturasChartData['data']) ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

</script>
