<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dashboard.css">
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
                    <!-- <i class="lni lni-grid-alt"></i> -->
                    <img src="img/foia.png" class="lni lni-grid-alt foia" alt="uma foia verde">
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
                        <span>Criar Jardim</span></a>
                    </a>
                </li>
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-protection"></i>
                        <span>Auth</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Num sei</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Num sei</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                        <i class="lni lni-layout"></i>
                        <span>Num sei</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                Num sei
                            </a>
                            <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 1</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> -->
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Numsei</span>
                    </a>
                </li> -->
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

                <!-- <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-img-container">
                            <img src="img/tomate.webp" class="card-img-top" alt="#">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Tomate</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Tipo:</h6>
                            <p class="card-text">Descrição: </p>
                            <p class="card-text"><small class="text-muted">Sensor ID: </small></p>
                            <div class="humidity-chart-container">
                                <canvas id="humidityChart" width="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div> -->


                <div class="container">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-img-container">
                                    <img src="img/tomate.webp" class="card-img-top" alt="#">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Tomate</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Tipo:</h6>
                                    <p class="card-text">Descrição: </p>
                                    <p class="card-text"><small class="text-muted">Sensor ID: </small></p>
                                    <div class="humidity-chart-container">
                                        <canvas class="humidityChart" width="100"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-img-container">
                                    <img src="img/tomate.webp" class="card-img-top" alt="#">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Tomate</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Tipo:</h6>
                                    <p class="card-text">Descrição: </p>
                                    <p class="card-text"><small class="text-muted">Sensor ID: </small></p>
                                    <div class="humidity-chart-container">
                                        <canvas class="humidityChart" width="100"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-img-container">
                                    <img src="img/tomate.webp" class="card-img-top" alt="#">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Tomate</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Tipo:</h6>
                                    <p class="card-text">Descrição: </p>
                                    <p class="card-text"><small class="text-muted">Sensor ID: </small></p>
                                    <div class="humidity-chart-container">
                                        <canvas class="humidityChart" width="100"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-img-container">
                                    <img src="img/tomate.webp" class="card-img-top" alt="#">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Tomate</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Tipo:</h6>
                                    <p class="card-text">Descrição: </p>
                                    <p class="card-text"><small class="text-muted">Sensor ID: </small></p>
                                    <div class="humidity-chart-container">
                                        <canvas class="humidityChart" width="100"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

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

                                <!-- Card para o botão de ligar/desligar o sistema de irrigação -->
                                <div class="col-md-3 mb-3">
                                    <div class="card d-flex flex-column">
                                        <div class="card-body">
                                            <h5 class="card-title">Sistema de Irrigação</h5>
                                            <p id="irrigationStatus">Status: Desligado</p>
                                        </div>
                                        <div class="card-footer d-flex justify-content-center">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="irrigationToggle" role="switch">
                                                <label class="form-check-label" for="irrigationToggle">Ligar/Desligar</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card para a API do tempo -->
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Clima em Itapira, SP</h5>
                                            <div id="weather-container">
                                                <img id="weather-icon" class="weather-icon" alt="Ícone do Tempo">
                                                <p id="weather-description"></p>
                                                <p id="weather-temperature"></p>
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/dashboard.js"></script>

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

        // Função para alternar o estado do sistema de irrigação
        document.getElementById('irrigationToggle').addEventListener('change', function() {
            const status = this.checked ? 'Ligado' : 'Desligado';
            document.getElementById('irrigationStatus').textContent = `Status: ${status}`;
        });

        // API do tempo (usando OpenWeatherMap como exemplo)
        async function fetchWeather() {
            const apiKey = 'c1463bf525fc62e190a035afadd8f9e8';
            const city = 'Itapira,BR';
            const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&lang=pt_br&appid=${apiKey}`;
            try {
                const response = await fetch(url);
                const data = await response.json();
                const temperature = data.main.temp;
                const description = data.weather[0].description;
                const icon = data.weather[0].icon;
                const iconUrl = `http://openweathermap.org/img/wn/${icon}@2x.png`;

                document.getElementById('weather-icon').src = iconUrl;
                document.getElementById('weather-description').textContent = description;
                document.getElementById('weather-temperature').textContent = `Temperatura: ${temperature}°C`;
            } catch (error) {
                console.error('Erro ao buscar dados do tempo:', error);
                document.getElementById('weather-description').textContent = 'Erro ao buscar dados do tempo';
            }
        }

        fetchWeather();
    </script>

</body>

</html>