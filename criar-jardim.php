<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dashboard.css">
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

                <div class="container mt-5">
                    <!-- Navigation Bar -->
                    <nav class="navbar navbar-light bg-light">
                        <a class="navbar-brand" href="#">Garden Manager</a>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createGardenModal">Create
                            Garden</button>
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
                                    <h5 class="modal-title" id="createGardenModalLabel">Add Plant/Crop</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="gardenForm">
                                        <div class="mb-3">
                                            <label for="plantName" class="form-label">Plant/Crop Name</label>
                                            <input type="text" class="form-control" id="plantName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="plantType" class="form-label">Type</label>
                                            <input type="text" class="form-control" id="plantType" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="plantDescription" class="form-label">Description</label>
                                            <textarea class="form-control" id="plantDescription" rows="3" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="plantImage" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="plantImage" accept="image/*" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        $('#gardenForm').on('submit', function(event) {
                            event.preventDefault();

                            // Get form values
                            const plantName = $('#plantName').val();
                            const plantType = $('#plantType').val();
                            const plantDescription = $('#plantDescription').val();
                            const plantImageFile = $('#plantImage')[0].files[0];

                            if (plantImageFile) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const plantImage = e.target.result;

                                    // Create a new card
                                    const cardHtml = `
                                        <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img src="${plantImage}" class="card-img-top" alt="${plantName}">
                                            <div class="card-body">
                                            <h5 class="card-title">${plantName}</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">${plantType}</h6>
                                            <p class="card-text">${plantDescription}</p>
                                            </div>
                                        </div>
                                        </div>
                                    `;

                                    // Append the card to the container
                                    $('#cardsContainer').append(cardHtml);

                                    // Clear the form
                                    $('#gardenForm')[0].reset();

                                    // Close the modal using Bootstrap's modal method
                                    var modal = bootstrap.Modal.getInstance(document.getElementById('createGardenModal'));
                                    modal.hide();
                                }
                                reader.readAsDataURL(plantImageFile);
                            }
                        });
                    });
                </script>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/dashboard.js"></script>
</body>

</html>