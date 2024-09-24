<?php
require("../Loesung_4/start.php");

// Prüfen, ob der Benutzer bereits angemeldet ist
if (isset($_SESSION["user"]) && !empty($_SESSION["user"])) {
    header("Location: friends.php");
}

// Verarbeiten der Formulareingaben
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Benutzername und Passwort vom Formular erhalten
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    // Aufruf der Login-Methode im BackendService
    $service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);
    $loginResult = $service->login($username, $password);

    if ($loginResult) {
        // Erfolgreich angemeldet
        $_SESSION["user"] = $username;
        header("Location: friends.php");
        exit();
    } else {
        // Fehler bei der Anmeldung
        $errorMessage = "Fehler bei der Anmeldung. Überprüfen Sie Ihre Benutzername und Passwort.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Chat</title>
  </head>
  <body>
  <div class="d-flex flex-column justify-content-center align-items-center vh-100">
    <img
      src="./images/chat.png"
      alt="Speechbubbles"
      width="100px"
      height="100px"
    />
    <h1>Please sign in</h1>
    <form class="inputs" action="register.php" method="post">
      <fieldset>
        <div class="mb-3"> <!-- Bootstrap class for margin bottom -->
          <label for="username" class="form-label"></label>
          <input
            type="text"
            class="form-control"
            placeholder="Username"
            id="username"
            name="username"
          /> <!-- Bootstrap class for form control -->
          <label for="password" class="form-label"></label>
          <input
            type="password"
            class="form-control"
            placeholder="Password"
            id="password"
            name="password"
          /> <!-- Bootstrap class for form control -->
        </div>
      </fieldset>
      <button type="submit" class="btn btn-primary">Register</button>
      <button type="submit" formaction="login.php" class="btn btn-success">Login</button>
    </form>
    <script src="./main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>

