<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/dashboard.css">
    <style>
        .humidity-chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 150px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
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
                    <a href="#" class="sidebar-link">
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

                <div class="container mt-5">
                    <!-- Navigation Bar -->
                    <nav class="navbar navbar-expand-lg navbar-light bg-light p-3 rounded">
                        <a class="navbar-brand" href="#">Gerenciar Jardins</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <div class="btn-group ms-auto" role="group" aria-label="Button group">
                                <button class="btn btn-primary me-3 rounded" data-bs-toggle="modal" data-bs-target="#createGardenModal">Criar Jardim</button>
                                <button class="btn btn-danger rounded" id="deleteSelected">Deletar Selecionados</button>
                            </div>
                        </div>
                    </nav>

                    <!-- Cards Container -->
                    <div class="row mt-4" id="cardsContainer">
                        <!-- Cards will be appended here -->
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="createGardenModal" tabindex="-1" aria-labelledby="createGardenModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createGardenModalLabel">Adicionar planta/Cultura</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="gardenForm">
                                        <div class="mb-3">
                                            <label for="plantName" class="form-label">Nome da planta/cultura</label>
                                            <input type="text" class="form-control" id="plantName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="plantType" class="form-label">Tipo</label>
                                            <input type="text" class="form-control" id="plantType" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="plantDescription" class="form-label">Descrição</label>
                                            <textarea class="form-control" id="plantDescription" rows="3" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="sensorId" class="form-label">Sensor ID</label>
                                            <input type="text" class="form-control" id="sensorId" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="plantImage" class="form-label">Imagem</label>
                                            <input type="file" class="form-control" id="plantImage" accept="image/*" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modify Modal -->
                    <div class="modal fade" id="modifyGardenModal" tabindex="-1" aria-labelledby="modifyGardenModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modifyGardenModalLabel">Modificar planta/cultura</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="modifyForm">
                                        <input type="hidden" id="modifyCardId">
                                        <div class="mb-3">
                                            <label for="modifyPlantName" class="form-label">Nome da planta/cultura</label>
                                            <input type="text" class="form-control" id="modifyPlantName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="modifyPlantType" class="form-label">Tipo</label>
                                            <input type="text" class="form-control" id="modifyPlantType" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="modifyPlantDescription" class="form-label">Descrição</label>
                                            <textarea class="form-control" id="modifyPlantDescription" rows="3" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="modifySensorId" class="form-label">Sensor ID</label>
                                            <input type="text" class="form-control" id="modifySensorId" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="modifyPlantImage" class="form-label">Imagem</label>
                                            <input type="file" class="form-control" id="modifyPlantImage" accept="image/*">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmação de exclusão</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Tem certeza de que deseja excluir este cartão?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger" id="confirmDelete">Excluir</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="js/criar-jardim.js"></script>
</body>

</html>