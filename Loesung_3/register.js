function checkInputUser() {
  const username = document.querySelector("#username");
  if (username.value === "" || username.value.length < 3) {
            username.classList.remove("correct");
            username.classList.add("wrong");
  } else {
            username.classList.remove("wrong");
            username.classList.add("correct");
        }
}

function checkInputPassword() {
  const passwordField = document.querySelector("#password");
  const confirmPwField = document.querySelector("#confirmPw");

  if (
    (passwordField.value === "" || passwordField.value.length < 8) ||
        (confirmPwField.value === "" || confirmPwField.value.length < 8) ||
        (passwordField.value !== confirmPwField.value)
        ) {
    passwordField.classList.remove("correct");
    passwordField.classList.add("wrong");
    confirmPwField.classList.remove("correct");
    confirmPwField.classList.add("wrong");
  } else {
    passwordField.classList.remove("wrong");
    passwordField.classList.add("correct");
    confirmPwField.classList.remove("wrong");
    confirmPwField.classList.add("correct");
  }
}


document.querySelector("#username").addEventListener("keyup", checkInputUser);
document.querySelector("#password").addEventListener("keyup", checkInputPassword);
document.querySelector("#confirmPw").addEventListener("keyup", checkInputPassword);

