<?php
require "../Loesung_4/start.php";

$user = null;
$text = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password_repeat = isset($_POST["confirmPw"]) ? $_POST["confirmPw"] : "";

    if (empty($username) || strlen($username) < 3) {
        $text = "Der Benutzername darf nicht leer sein und muss mindestens drei Zeichen haben.";
        $_SESSION["user"] = $username;
    } elseif ($service->userExists($username)) {
        $text = "Benutzername bereits vergeben.";
    } elseif (empty($password) || strlen($password) < 8) {
        $text = "Passwort darf nicht leer sein oder unter 8 Zeichen lang.";
    } elseif ($password != $password_repeat) {
        $text = "Die Passwörter stimmen nicht überein";
    } else {
        if ($service->register($username, $password)) {
            $_SESSION["user"] = $username;
            http_response_code(204);
            header("Location: friends.php");
            exit();
        } else {
            $text = "Fehler aufgetreten beim registrieren.";
            http_response_code(404);
        }
        $text = "Registrierung erfolgreich.";
        exit();
    }

} else {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Register</title>
</head>

<body>
<div class="d-flex flex-column justify-content-center align-items-center vh-100">
<img src="./images/user.png" alt="User" width="100px" height="100px"/>
<h1>Register yourself</h1>
<div class="container">
    <form action="register.php" method="post" class="container needs-validated" novalidate>
        <fieldset>
            <div class="mb-3">
                <label for="username"></label>
                <input type="text" class="form-control" placeholder="Username" id="username" name="username" required>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please choose a username.</div>

                <label for="password"></label>
                <input type="password" class="form-control" placeholder="Password" id="password" 
                    name="password" required>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please choose a password.</div>
                
                <label for="confirmPw"></label>
                <input type="password" class="form-control" placeholder="Confirm Password" 
                    id="confirmPw" name="confirmPw" required>
                <div class="valid-feedback">Passwords match!</div>
                <div class="invalid-feedback">Passwords do not match.</div>
            </div>
        </fieldset>
        <input type="submit" value="Create Account" class="btn btn-success">
        <input type="submit" value="Cancel" class="btn btn-danger" formnovalidate formaction="login.php">
    </form>

    <?php
    if (!(empty($user) && empty($password) && empty($password_repeat))) {
        if ($valid) {
            echo '<div class="alert alert-success" role="alert">Registration successful!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Registration failed. Please check your inputs.</div>';
        }
        exit();
    }
    ?>

</div>
<script src="./main.js"></script>
<script src="../Loesung_3/register.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>