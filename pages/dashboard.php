<?php
// require './check-session.php';
require "../model/Garden.php";






session_start();
$userId = $_SESSION['user_id']['id'];
$gardens = Garden::getAllGardensByUserId($userId);

$gardensQuantity = Garden::count();



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

                <!--
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Configurações</span>
                    </a>
                </li>
                -->
            </ul>
            <div class="sidebar-footer">
                <a href="/pi-horta-inteligente/pages/logout.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main p-3 text-center">
            <div>
                <nav class="navbar navbar-expand-lg bg-white p-3 rounded-lg mb-3">
                    <h1 class="navbar-brand">Dashboard</h1>
                    <div id="weather" class="ms-auto d-flex align-items-center">
                        <img id="weather-icon" src="" alt="Weather Icon" class="me-2">
                        <span id="weather-description"></span>
                    </div>
                </nav>
                <div class="container">
                    <div class="row d-flex justify-content-center" style='display: flex; gap:20px;'>
                        <?php foreach ($gardens as $index => $garden) : ?>
                            <div class="col-md-4" style='flex: 1; min-width: 300px; max-width: 300px'>
                                <div class="card position-relative">
                                    <div style='height: 200px;'>
                                        <img src="../uploads/<?php echo $garden['plant_image']; ?>" class="" style='width: 100%; height: 100%; object-fit: cover' alt="Imagem do Jardim">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-center" style="font-size: 1.25rem;"><?php echo $garden['plant_name']; ?></h5>
                                        <p class="card-text text-center" style="font-size: 0.9rem;">Tipo: <strong><?php echo $garden['plant_type']; ?></strong></p>
                                        <p class="card-text text-center" style="font-size: 0.9rem;">Umidade do solo: <strong><?php echo $garden['soil_moisture']; ?>%</strong></p>
                                        <p class="card-text text-center" style="font-size: 0.9rem;">Data de plantio: <strong><?php echo date('d/m/Y', strtotime($garden['planting_date'])); ?></strong></p>
                                        <p class="card-text text-center" style="font-size: 0.9rem;">Data de colheita: <strong><?php echo $garden['harvest_date'] != '0000-00-00' ? date('d/m/Y', strtotime($garden['harvest_date'])) : "Nenhuma data definida"; ?></strong></p>
                                        <p class="card-text text-center" style="font-size: 0.9rem;">Notas adicionais: <strong><?php echo $garden['additional_notes']; ?></strong></p>
                                        <div class="humidity-chart-container">
                                            <canvas class="humidityChart" id="humidityChart<?php echo $index; ?>" data-plant-id="plant<?php echo $index + 1; ?>" width="100"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="container">
                            <div class="row">
                                <!-- Gráfico de Economia de Água -->
                                <div class="col-md-12 mb-3">
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
        async function fetchWeather() {
            const apiKey = 'c1463bf525fc62e190a035afadd8f9e8';
            const city = 'Itapira,BR';
            const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric&lang=pt_br`;

            try {
                const response = await fetch(url);
                const data = await response.json();
                if (data.cod === 200) {
                    const icon = `http://openweathermap.org/img/wn/${data.weather[0].icon}.png`;
                    const description = `${data.weather[0].description}, ${data.main.temp}°C`;

                    document.getElementById('weather-icon').src = icon;
                    document.getElementById('weather-description').textContent = description;
                } else {
                    console.error('Erro ao buscar dados do tempo:', data.message);
                }
            } catch (error) {
                console.error('Erro ao buscar dados do tempo:', error);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchWeather();
        });
    </script>


    <script>
        async function fetchHumidityData(plantId) {
            try {
                const response = await fetch(`http://localhost:8000/humidity/${plantId}`);
                const data = await response.json();
                console.log(`Dados recebidos da API para ${plantId}:`, data);
                return data[0];
            } catch (error) {
                console.error('Erro ao buscar dados da API:', error);
            }
        }

        async function updateChart(chart, plantId) {
            const humidityData = await fetchHumidityData(plantId);
            if (!humidityData || humidityData.humidity === undefined || humidityData.remaining === undefined) {
                console.error("Dados inválidos recebidos da API:", humidityData);
                return;
            }
            console.log('Atualizando gráfico com dados:', humidityData);
            chart.data.datasets[0].data = [humidityData.humidity, humidityData.remaining];
            chart.update();
        }

        function createHumidityChart(ctx) {
            return new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Umidade', 'Restante'],
                    datasets: [{
                        label: 'Umidade do Solo',
                        data: [0, 0],
                        backgroundColor: ["#4caf50", "#d32f2f"],
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
                        const percentageText = isNaN(percentageValue) ? '0%' : `${percentageValue}%`;

                        ctx.font = 'bold 18px Arial';
                        ctx.fillStyle = percentageValue < 50 ? '#d32f2f' : '#4caf50';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.fillText(percentageText, width / 2, height / 2);
                        ctx.restore();
                    }
                }]
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.humidityChart').forEach((canvas, index) => {
                const ctx = canvas.getContext('2d');
                const plantId = canvas.getAttribute('data-plant-id');
                const humidityChart = createHumidityChart(ctx);

                setInterval(() => {
                    updateChart(humidityChart, plantId);
                }, 5000);
            });
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