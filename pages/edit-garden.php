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
                        <img src="/pi-horta-inteligente/uploads/<?php echo $currentlyGardenData['plant_image'] ?>" class="card-img-top" alt="Imagem do Jardim" style="max-width: 200px; align-self: center; margin-block: 10px; border-radius: 5px">
                    </div>
                    <div class="mb-3">

                        <label for="plantName" class="form-label">Nome da planta/cultura</label>
                        <input type="text" class="form-control" id="plantName" name="plantName" value="<?= htmlspecialchars($currentlyGardenData['plant_name']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="plantType" class="form-label">Tipo</label>
                        <input type="text" class="form-control" id="plantType" name="plantType" value="<?= htmlspecialchars($currentlyGardenData['plant_type']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="plantDescription" class="form-label">Descrição</label>
                        <textarea class="form-control" id="plantDescription" name="plantDescription" rows="3"><?= htmlspecialchars($currentlyGardenData['plant_description']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="plantImage" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="plantImage" name="plantImage" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>