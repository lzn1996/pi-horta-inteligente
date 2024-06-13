<?php
require "../model/Garden.php";
$gardens = Garden::getAll();
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
    <title>Sidebar With Bootstrap</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/dashboard.css">
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
        <aside id="sidebar" class="expand">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <!-- <i class="lni lni-grid-alt"></i> -->
                    <img src="../img/foia.png" class="lni lni-grid-alt foia" alt="uma foia verde">
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
                <a href="./pages/logout.php" class="sidebar-link">
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
                                <?php if ($gardensQuantity < 1) {
                                    echo '
                                                            <button class="btn btn-primary me-3 rounded" data-bs-toggle="modal" data-bs-target="#createGardenModal">Criar Jardim</button>

                            ';
                                }
                                ?>
                                <?php if ($gardensQuantity > 1) {
                                    echo '
                                    <a type="button" href="../pages/delete-all-garden.php" class="btn btn-danger rounded" id="deleteSelected">Deletar todos</a>
                                    ';
                                }
                                ?>
                            </div>
                        </div>
                    </nav>
                    <?php if (!empty($gardenCreatedErrorMsg)) : ?>
                        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                            <?php echo $gardenCreatedErrorMsg; ?>
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Fechar"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($gardenCreatedSuccessMsg)) : ?>
                        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                            <?php echo $gardenCreatedSuccessMsg; ?>
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Fechar"></button>
                        </div>
                    <?php endif; ?>
                    <!-- Cards Container -->
                    <div class="row mt-4" id="cardsContainer">
                        <?php
                        foreach ($gardens as $garden) {
                            $id = $garden['id'];
                            $plantName = $garden['plant_name'];
                            $plantType = $garden['plant_type'];
                            $plantDescription = $garden['plant_description'];
                            $plantImage = $garden['plant_image'];
                        ?>
                            <div class="col-md-4">
                                <div class="card position-relative">
                                    <img src="../uploads/<?php echo $plantImage; ?>" class="card-img-top" alt="Imagem do Jardim">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $plantName; ?></h5>
                                        <p class="card-text"><?php echo $plantDescription; ?></p>
                                        <div class="position-absolute" style='top: 5px; right: 5px'>
                                            <a href="../pages/edit-garden.php/?garden-id=<?= $id ?>" class="btn btn-warning"><i class="lni lni-pencil"></i></a>
                                            <a href="../pages/delete-garden.php/?garden-id=<?= $id ?>" class="btn btn-danger"><i class="lni lni-trash-can"></i></a>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <a href="#" class="btn btn-primary">Detalhes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php
                        }
                        ?>
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
                                    <form id="gardenForm" method='post' action="../pages/garden-save.php" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="plantName" class="form-label">Nome da planta/cultura</label>
                                            <input type="text" class="form-control" id="plantName" name="plantName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="plantType" class="form-label">Tipo</label>
                                            <input type="text" class="form-control" id="plantType" name="plantType" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="plantDescription" class="form-label">Descrição</label>
                                            <textarea class="form-control" id="plantDescription" name="plantDescription" rows="3" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="plantImage" class="form-label">Imagem</label>
                                            <input type="file" class="form-control" id="plantImage" name="plantImage" accept="image/*" required>
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

    <!-- <script src="js/criar-jardim.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/sidebar.js"></script>

</body>

</html>