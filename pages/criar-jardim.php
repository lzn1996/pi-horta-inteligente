<?php
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
    <title>Sidebar With Bootstrap</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/dashboard.css">
    <style>
        <?php if ($gardensQuantity < 2) : ?>#cardsContainer {
            justify-content: center;
        }

        <?php endif; ?>
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
            </ul>
            <div class="sidebar-footer">
                <a href="/pi-horta-inteligente/pages/logout.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main p-3">
            <div>
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

                                <?php if ($gardensQuantity > 1) {
                                    echo '
                                    <a type="button" href="../pages/delete-all-garden.php" class="btn btn-danger rounded" id="deleteSelected">Deletar todos</a>
                                    ';
                                }
                                ?>
                            </div>
                        </div>
                    </nav>

                    <!-- Alerts -->
                    <?php if (!empty($gardenCreatedErrorMsg)) : ?>
                        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                            <?php echo $gardenCreatedErrorMsg; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($gardenCreatedSuccessMsg)) : ?>
                        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                            <?php echo $gardenCreatedSuccessMsg; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Cards Container -->
                    <div class="row mt-4" id="cardsContainer" style='display: flex; gap:20px;'>
                        <?php foreach ($gardens as $garden) : ?>
                            <div class="col-md-4" style='flex: 1; flex-basis: 300px; max-width: 600px'>
                                <div class="card position-relative">
                                    <img src="../uploads/<?php echo $garden['plant_image']; ?>" class="card-img-top" alt="Imagem do Jardim">
                                    <div class="card-body">
                                        <h5 class="card-title" style="font-size: 1.25rem;"><?php echo $garden['plant_name']; ?></h5>
                                        <p class="card-text" style="font-size: 0.9rem;">Tipo: <strong><?php echo $garden['plant_type']; ?></strong></p>
                                        <p class="card-text" style="font-size: 0.9rem;">Umidade do solo: <strong><?php echo $garden['soil_moisture']; ?></strong></p>
                                        <p class="card-text" style="font-size: 0.9rem;">Data de plantio: <strong><?php echo $garden['planting_date']; ?></strong></p>
                                        <p class="card-text" style="font-size: 0.9rem;">Data de colheita: <strong><?php echo $garden['harvest_date']; ?></strong></p>
                                        <p class="card-text" style="font-size: 0.9rem;">Notas adicionais: <strong><?php echo $garden['additional_notes']; ?></strong></p>
                                        <div class="position-absolute" style="top: 5px; right: 5px;">
                                            <a href="/pi-horta-inteligente/pages/edit-garden.php/?garden-id=<?= $garden['id'] ?>" class="btn btn-warning"><i class="lni lni-pencil"></i></a>
                                            <a href="/pi-horta-inteligente/pages/delete-garden.php/?garden-id=<?= $garden['id'] ?>" class="btn btn-danger"><i class="lni lni-trash-can"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="createGardenModal" tabindex="-1" aria-labelledby="createGardenModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createGardenModalLabel">Adicionar planta/cultura</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="gardenForm" method='post' action="../pages/garden-save.php" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="plantName" class="form-label" style="text-align: initial;">Nome da planta/cultura:</label>
                                            <input type="text" class="form-control" id="plantName" name="plantName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" style="text-align: initial;">Tipo de plantio:</label>
                                            <div style="display: flex; gap: 1rem; align-items: center;">
                                                <div>
                                                    <input type="radio" id="planta" name="plantType" value="Planta" required>
                                                    <label for="planta" style="text-align: initial;">Planta</label>
                                                </div>
                                                <div>
                                                    <input type="radio" id="cultura" name="plantType" value="Cultura" required>
                                                    <label for="cultura" style="text-align: initial;">Cultura</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="soilMoisture" class="form-label" style="text-align: initial;">Umidade do solo desejada:</label>
                                            <input type="number" class="form-control" id="soilMoisture" name="soilMoisture" min="0" max="100" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="plantingDate" class="form-label" style="text-align: initial;">Data de plantio:</label>
                                            <input type="date" class="form-control" id="plantingDate" name="plantingDate" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="harvestDate" class="form-label" style="text-align: initial;">Data estimada de colheita:</label>
                                            <input type="date" class="form-control" id="harvestDate" name="harvestDate">
                                        </div>

                                        <div class="mb-3">
                                            <label for="additionalNotes" class="form-label" style="text-align: initial;">Notas adicionais:</label>
                                            <textarea class="form-control" id="additionalNotes" name="additionalNotes" rows="3"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="plantImage" class="form-label" style="text-align: initial;">Imagem</label>
                                            <input type="file" class="form-control" id="plantImage" name="plantImage" accept="image/*" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script src="../js/sidebar.js"></script>
</body>

</html>