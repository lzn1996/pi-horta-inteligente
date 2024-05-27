document
  .getElementById("createAccountForm")
  .addEventListener("keyup", (event) => {
    const createAccountButton = document.getElementById("createAccBtn");
    const password = document.getElementById("newPassword").value;
    const confirmPassword = document.getElementById("confirmNewPassword").value;
    const errorMessageParagraph = document.getElementById("errorMessage");
    const confirmMessageParagraph = document.getElementById("confirmMessage");

    if (password.length > 0 && password.length < 8) {
      errorMessageParagraph.innerText =
        "A senha deve ter no mínimo 8 caracteres.";
      createAccountButton.disabled = true;
      return;
    }

    if (password !== confirmPassword) {
      confirmMessageParagraph.innerText = "As senhas não coincidem.";
      createAccountButton.disabled = true;
      return;
    }

    if (password === confirmPassword && password.length >= 8) {
      confirmMessageParagraph.innerText = "";
      errorMessageParagraph.innerText = "";
      createAccountButton.disabled = false;
      createAccountButton.classList.add("btn-primary");
      createAccountButton.classList.remove("btn-light");
    }
  });
function getParameterByName(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, "\\$&");
  const regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}

const successParam = getParameterByName("success");
if (successParam !== null) {
  let message = "";
  let alertClass = "";
  if (successParam === "true") {
    message = "Usuário cadastrado com sucesso!";
    alertClass = "alert-success";
  } else {
    message =
      "Já existe um usuário cadastrado com esse email. Por favor, escolha outro.";
    alertClass = "alert-danger";
  }

  const alertDiv = document.createElement("div");
  alertDiv.className = "alert " + alertClass;
  alertDiv.setAttribute("role", "alert");
  alertDiv.innerHTML =
    message +
    '<button type="button" onclick="removeSuccessParam()" class="btn-close m-2" style="font-size: 10px" data-bs-dismiss="alert" aria-label="Close"></button>';

  const formContainer = document.querySelector(".form-container");
  formContainer.insertBefore(alertDiv, formContainer.firstChild);
}
function removeSuccessParam() {
  const urlWithoutSuccessParam = window.location.href.split("?")[0];
  history.replaceState({}, document.title, urlWithoutSuccessParam);
}

document
  .querySelector('[data-bs-target="#createAccountModal"]')
  .addEventListener("click", function () {
    removeSuccessParam();
  });
