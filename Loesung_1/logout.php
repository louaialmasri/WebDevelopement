<?php
require("../Loesung_4/start.php");

// Sitzungsinformationen bereinigen
session_unset();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Logout</title>
</head>
<body class="text-center"> <!-- Bootstrap class for centering text -->
    <img src="./images/logout.png" alt="Log out image" width="100px" height="100px"
        class="mt-5 mb-3"> <!-- Bootstrap class for margin top and bottom -->
    <h1 class="mb-3">Logged out ...</h1> <!-- Bootstrap class for margin bottom -->
    <p class="mb-4">See you!</p> <!-- Bootstrap class for margin bottom -->
    <a href="login.php" class="btn btn-primary">Login again</a> <!-- Bootstrap classes for button -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
