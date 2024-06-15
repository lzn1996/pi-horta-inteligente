<?php
require_once "../model/Garden.php";

$gardenId = $_GET['garden-id'];

$currentlyGardenData = Garden::getById($gardenId);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Editar Jardim</title>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form id="gardenForm" method='post' action="/pi-horta-inteligente/pages/edit-garden-save.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $gardenId ?>">
                    <div class="card mb-3">
                        <img src="/pi-horta-inteligente/uploads/<?= $currentlyGardenData['plant_image'] ?>" class="card-img-top" alt="Imagem do Jardim" style="max-width: 200px; align-self: center; margin-block: 10px; border-radius: 5px">
                    </div>
                    <div class="mb-3">
                        <label for="plantName" class="form-label">Nome da planta/cultura</label>
                        <input type="text" class="form-control" id="plantName" name="plantName" value="<?= htmlspecialchars($currentlyGardenData['plant_name']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="plantType" class="form-label">Tipo</label>
                        <div style="display: flex; gap: 1rem; align-items: center;">
                            <div>
                                <input type="radio" id="planta" name="plantType" value="Planta" <?php if ($currentlyGardenData['plant_type'] === 'Planta') echo 'checked'; ?> required>
                                <label for="planta" style="text-align: initial;">Planta</label>
                            </div>
                            <div>
                                <input type="radio" id="cultura" name="plantType" value="Cultura" <?php if ($currentlyGardenData['plant_type'] === 'Cultura') echo 'checked'; ?> required>
                                <label for="cultura" style="text-align: initial;">Cultura</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="soilMoisture" class="form-label">Umidade do Solo (%)</label>
                        <input type="number" class="form-control" id="soilMoisture" name="soilMoisture" value="<?= htmlspecialchars($currentlyGardenData['soil_moisture']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="plantingDate" class="form-label">Data de Plantio</label>
                        <input type="date" class="form-control" id="plantingDate" name="plantingDate" value="<?= htmlspecialchars($currentlyGardenData['planting_date']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="harvestDate" class="form-label">Data de Colheita</label>
                        <input type="date" class="form-control" id="harvestDate" name="harvestDate" value="<?= htmlspecialchars($currentlyGardenData['harvest_date']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="additionalNotes" class="form-label">Notas Adicionais</label>
                        <textarea class="form-control" id="additionalNotes" name="additionalNotes" rows="3"><?= htmlspecialchars($currentlyGardenData['additional_notes']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="plantImage" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="plantImage" name="plantImage" accept="image/*">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>