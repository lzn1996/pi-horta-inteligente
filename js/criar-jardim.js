$(document).ready(function () {
  let currentCardId = 0;
  const charts = {};

  // Function to create card HTML
  function createCardHtml(id, name, type, description, image, sensorId) {
    return `
            <div class="col-md-4 mb-3" data-card-id="${id}">
                <div class="card">
                    <div class="card-img-container">
                        <input type="checkbox" class="delete-checkbox">
                        <img src="${image}" class="card-img-top" alt="${name}">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">${name}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Tipo: ${type}</h6>
                        <p class="card-text">Descrição: ${description}</p>
                        <p class="card-text"><small class="text-muted">Sensor ID: ${sensorId}</small></p>
                        <div class="humidity-chart-container">
                            <canvas id="humidityChart${id}"></canvas>
                        </div>
                        <button class="btn btn-warning btn-sm modify-button mt-3" data-bs-toggle="modal" data-bs-target="#modifyGardenModal">Modificar</button>
                    </div>
                </div>
            </div>
        `;
  }

  // Plugin para centralizar o texto no gráfico
  Chart.register({
    id: "centerTextPlugin",
    beforeDraw: function (chart) {
      const ctx = chart.ctx;
      const width = chart.width;
      const height = chart.height;
      const centerX = width / 2;
      const centerY = height / 2;

      // Obtém o valor da umidade
      const humidityValue = chart.config.data.datasets[0].data[0];

      ctx.save();
      ctx.textAlign = "center";
      ctx.textBaseline = "middle";
      ctx.font = "bold 18px Arial";
      ctx.fillStyle = "#4caf50";
      ctx.fillText(`${humidityValue}%`, centerX, centerY);
      ctx.restore();
    },
  });

  // Função para criar o gráfico de umidade
  function createHumidityChart(chartId, humidityValue) {
    const ctx = document.getElementById(chartId).getContext("2d");
    const chart = new Chart(ctx, {
      type: "doughnut",
      data: {
        datasets: [
          {
            data: [humidityValue, 100 - humidityValue],
            backgroundColor: ["#4caf50", "#d32f2f"],
            borderWidth: 0,
          },
        ],
      },
      options: {
        responsive: true,
        cutout: "80%",
        plugins: {
          tooltip: {
            enabled: false,
          },
          legend: {
            display: false,
          },
        },
      },
      plugins: [Chart.registry.getPlugin("centerTextPlugin")],
    });
    return chart;
  }

  // Update chart with new humidity value
  function updateHumidityChart(chart, humidityValue) {
    chart.data.datasets[0].data = [humidityValue, 100 - humidityValue];
    chart.options.plugins.title.text = `${humidityValue}%`;
    chart.update();
  }

  // Add plant/crop
  $("#gardenForm").on("submit", function (event) {
    event.preventDefault();

    // Get form values
    const plantName = $("#plantName").val();
    const plantType = $("#plantType").val();
    const plantDescription = $("#plantDescription").val();
    const sensorId = $("#sensorId").val();
    const plantImageFile = $("#plantImage")[0].files[0];

    if (plantImageFile) {
      const reader = new FileReader();
      reader.onload = function (e) {
        const plantImage = e.target.result;

        // Create a new card
        const cardHtml = createCardHtml(
          currentCardId,
          plantName,
          plantType,
          plantDescription,
          plantImage,
          sensorId
        );

        // Append the card to the container
        $("#cardsContainer").append(cardHtml);

        // Create the humidity chart
        const chart = createHumidityChart(
          `humidityChart${currentCardId}`,
          Math.floor(Math.random() * 101)
        );
        charts[`humidityChart${currentCardId}`] = chart;

        // Update chart every 5 seconds
        setInterval(() => {
          const newHumidityValue = Math.floor(Math.random() * 101);
          updateHumidityChart(chart, newHumidityValue);
        }, 5000);

        // Increment card ID
        currentCardId++;

        // Clear the form
        $("#gardenForm")[0].reset();

        // Close the modal using Bootstrap's modal method
        var modal = bootstrap.Modal.getInstance(
          document.getElementById("createGardenModal")
        );
        modal.hide();
      };
      reader.readAsDataURL(plantImageFile);
    }
  });

  // Modify plant/crop
  $("#cardsContainer").on("click", ".modify-button", function () {
    const card = $(this).closest("[data-card-id]");
    const cardId = card.data("card-id");
    const cardTitle = card.find(".card-title").text();
    const cardSubtitle = card
      .find(".card-subtitle")
      .text()
      .replace("Tipo: ", "");
    const cardText = card
      .find(".card-text")
      .first()
      .text()
      .replace("Descrição: ", "");
    const cardSensorId = card.find(".card-text small").text().split(": ")[1];
    const cardImage = card.find(".card-img-top").attr("src");

    $("#modifyCardId").val(cardId);
    $("#modifyPlantName").val(cardTitle);
    $("#modifyPlantType").val(cardSubtitle);
    $("#modifyPlantDescription").val(cardText);
    $("#modifySensorId").val(cardSensorId);
    $("#modifyPlantImage").val("");
  });

  $("#modifyForm").on("submit", function (event) {
    event.preventDefault();

    // Get form values
    const cardId = $("#modifyCardId").val();
    const plantName = $("#modifyPlantName").val();
    const plantType = $("#modifyPlantType").val();
    const plantDescription = $("#modifyPlantDescription").val();
    const sensorId = $("#modifySensorId").val();
    const plantImageFile = $("#modifyPlantImage")[0].files[0];

    const card = $(`[data-card-id=${cardId}]`);
    const cardImage = card.find(".card-img-top");

    if (plantImageFile) {
      const reader = new FileReader();
      reader.onload = function (e) {
        const plantImage = e.target.result;

        card.find(".card-title").text(plantName);
        card.find(".card-subtitle").text(`Tipo: ${plantType}`);
        card.find(".card-text").first().text(`Descrição: ${plantDescription}`);
        card.find(".card-text small").text(`Sensor ID: ${sensorId}`);
        cardImage.attr("src", plantImage);

        // Update the humidity chart
        const chart = charts[`humidityChart${cardId}`];
        const newHumidityValue = Math.floor(Math.random() * 101);
        updateHumidityChart(chart, newHumidityValue);

        var modal = bootstrap.Modal.getInstance(
          document.getElementById("modifyGardenModal")
        );
        modal.hide();
      };
      reader.readAsDataURL(plantImageFile);
    } else {
      card.find(".card-title").text(plantName);
      card.find(".card-subtitle").text(`Tipo: ${plantType}`);
      card.find(".card-text").first().text(`Descrição: ${plantDescription}`);
      card.find(".card-text small").text(`Sensor ID: ${sensorId}`);

      // Update the humidity chart
      const chart = charts[`humidityChart${cardId}`];
      const newHumidityValue = Math.floor(Math.random() * 101);
      updateHumidityChart(chart, newHumidityValue);

      var modal = bootstrap.Modal.getInstance(
        document.getElementById("modifyGardenModal")
      );
      modal.hide();
    }
  });

  // Show delete confirmation modal when delete button is clicked
  $("#deleteSelected").on("click", function () {
    var modal = new bootstrap.Modal(
      document.getElementById("deleteConfirmationModal")
    );
    modal.show();
  });

  // Perform delete operation when "Delete" button in the modal is clicked
  $("#confirmDelete").on("click", function () {
    $(".delete-checkbox:checked").each(function () {
      $(this).closest("[data-card-id]").remove();
    });

    var modal = bootstrap.Modal.getInstance(
      document.getElementById("deleteConfirmationModal")
    );
    modal.hide();
  });
});
