<?php
// require './check-session.php';
require "../model/Garden.php";






session_start();
$userId = $_SESSION['user_id']['id'];
$gardens = Garden::getAllGardensByUserId($userId);

$gardensQuantity = Garden::count();

$gardenCreatedSuccessMsg = '';
$gardenCreatedErrorMsg = '';

if (isset($_GET['garden-created-success']) && $_GET['garden-created-success'] === 'true') {
    $gardenCreatedSuccessMsg = "Jardim criado com sucesso!";
}

if (isset($_GET['garden-created-error'])) {
    $gardenCreatedErrorMsg = "Não foi possível criar o jardim." . urldecode($_GET['garden-created-error']);
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .form-check-input:checked {
            background-color: #008000;
            border-color: #008000;
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(0, 128, 0, 0.25);
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <div class="wrapper">
            <aside id="sidebar" class="expand">
                <div class="d-flex">
                    <button class="toggle-btn" type="button">
                        <img class=foia src="../img/foia.png" alt="">
                    </button>
                    <div class="sidebar-logo">
                        <a href="#">SmartGarden</a>
                    </div>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="dashboard.php" class="sidebar-link">
                            <i class="lni lni-layout"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="criar-jardim.php" class="sidebar-link">
                            <i class="lni lni-sprout"></i>
                            <span>Meus Jardins</span></a>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="lni lni-cog"></i>
                            <span>Configurações</span>
                        </a>
                    </li>
                </ul>
                <div class="sidebar-footer">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-exit"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </aside>
            <div class="main p-3">
                <div class="text-center">

                    <nav class="navbar navbar-expand-lg navbar-light bg-light p-3 rounded">
                        <h1>Dashboard</h1>
                    </nav>


                    <div class="container">
                        <div class="row">
                            <?php foreach ($gardens as $garden) : ?>
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <div class="card-img-container">
                                            <img src="../uploads/<?php echo $garden['plant_image']; ?>" class="card-img-top" alt="Imagem da Planta">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $garden['plant_name']; ?></h5>
                                            <h6 class="card-subtitle mb-2 text-muted">Tipo: <?php echo $garden['plant_type']; ?></h6>
                                            <p class="card-text">Umidade do solo: <?php echo $garden['soil_moisture']; ?></p>
                                            <p class="card-text">Data de plantio: <?php echo $garden['planting_date']; ?></p>
                                            <p class="card-text">Data de colheita: <?php echo $garden['harvest_date']; ?></p>
                                            <p class="card-text">Notas adicionais: <?php echo $garden['additional_notes']; ?></p>
                                            <div class="humidity-chart-container">
                                                <canvas class="humidityChart" width="100"></canvas>
                                            </div>
                                            <!-- <div class="position-absolute" style="top: 5px; right: 5px;">
                                                <a href="/pi-horta-inteligente/pages/edit-garden.php/?garden-id=<?= $garden['id'] ?>" class="btn btn-warning"><i class="lni lni-pencil"></i></a>
                                                <a href="/pi-horta-inteligente/pages/delete-garden.php/?garden-id=<?= $garden['id'] ?>" class="btn btn-danger"><i class="lni lni-trash-can"></i></a>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <!-- Repita o bloco de colunas (col-md-3 mb-3) para adicionar mais cards -->


                            <div class="container">
                                <div class="row">
                                    <!-- Gráfico de Economia de Água -->
                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Economia de Água durante o Ano</h5>
                                                <canvas id="waterSavingsChart" width="400"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script src="../js/sidebar.js"></script>

        <script>
            function createHumidityChart(ctx) {
                const initialData = [70, 30]; // Initial data values

                return new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Umidade', 'Restante'],
                        datasets: [{
                            label: 'Umidade do Solo',
                            data: initialData,
                            backgroundColor: ["#4caf50", "#d32f2f"], // Initial colors
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '80%',
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                enabled: false
                            }
                        }
                    },
                    plugins: [{
                        id: 'percentagePlugin',
                        afterDraw: (chart) => {
                            const {
                                ctx,
                                chartArea: {
                                    width,
                                    height
                                }
                            } = chart;
                            ctx.save();
                            const total = chart.data.datasets[0].data.reduce((acc, value) => acc + value, 0);
                            const percentageValue = (chart.data.datasets[0].data[0] / total * 100).toFixed(1);
                            const percentageText = percentageValue + '%';

                            ctx.font = 'bold 18px Arial';
                            ctx.fillStyle = percentageValue < 50 ? '#d32f2f' : '#4caf50'; // Change color based on value
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'middle';
                            ctx.fillText(percentageText, width / 2, height / 2);
                            ctx.restore();
                        }
                    }]
                });
            }

            function getRandomHumidity() {
                const humidity = Math.floor(Math.random() * 101); // Random value between 0 and 100
                return [humidity, 100 - humidity];
            }

            document.querySelectorAll('.humidityChart').forEach((canvas, index) => {
                const ctx = canvas.getContext('2d');
                const humidityChart = createHumidityChart(ctx);

                setInterval(() => {
                    const newData = getRandomHumidity();
                    humidityChart.data.datasets[0].data = newData;
                    humidityChart.update();
                }, 5000);
            });
        </script>


        <script>
            const waterSavingsCtx = document.getElementById('waterSavingsChart').getContext('2d');

            const waterSavingsChart = new Chart(waterSavingsCtx, {
                type: 'line',
                data: {
                    labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    datasets: [{
                        label: 'Economia de Água (litros)',
                        data: [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

</body>

</html>