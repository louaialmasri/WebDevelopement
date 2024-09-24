<?php
require("../Loesung_4/start.php");

use Model\Friend;

if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
  header("Location: login.php");
}

$angemeldeterNutzer = $_SESSION["user"];
$allUsers = $service->loadUsers();
foreach ($allUsers as $user) {
  if ($user != "undefined" && $user != $angemeldeterNutzer) {
    echo "<input type='hidden' name='allUsers' id='allUsers' value='" . $user . "' />";
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'add-friend') {
      if (isset($_POST['addToList']) && !empty($_POST['addToList'])) {
        $friendAdd = $_POST['addToList'];
        $userExists = in_array($friendAdd, $allUsers);
        if ($userExists) {
          $newFriend = new Friend($friendAdd);
          $service->friendRequest($newFriend);
          header("Location: friends.php");
          exit();
        } else {
          echo "Der angegebene Benutzer existiert nicht.";
        }
      }
    } elseif (strpos($action, 'accept-') !== false) {
      $friendToAccept = str_replace('accept-', '', $action);
      $service->friendAccept($friendToAccept);
      header("Location: friends.php");
      exit();
    } elseif (strpos($action, 'reject-') !== false) {
      $friendToReject = str_replace('reject-', '', $action);
      $service->friendDismiss($friendToReject);
      header("Location: friends.php");
      exit();
    } elseif ($action === "remove-friend") {
      $friendToRemove = $_POST["friendToRemove"];
      $service->removeFriend($friendToRemove);
      header("Location: friends.php");
      exit();
    }
  }
}

$freunde = $service->loadFriends();
if (empty($freunde)) {
  echo "Keine Freundschaftsanfragen";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <title>Friends</title>
</head>

<body>
<div class="d-flex flex-column justify-content-center align-items-center vh-100">
  <header class="header">
    <h1>Friends</h1>
    <div class="navigation">
      <a href="./logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a> |
      <a href="./settings.php"><i class="fas fa-cog"></i> Settings</a>
    </div>
  </header>

  <hr />

  <ul class="freunde list-group">
    <?php
    foreach ($freunde as $freund) {
      if ($freund->getStatus() == 'accepted') {
        echo "<li><a class='akzeptierte Freunde freund' href='chat.php?friend=" 
          . $freund->getUsername() . "'>" . $freund->getUsername() . "</a></li>";
      }
    }
    ?>
  </ul>

  <hr />

  <header class="header">
    <h2>New Requests</h2>
    <div class="requests">
      <ul class="list-group">
        <?php
        foreach ($freunde as $freund) {
          if ($freund->getStatus() == 'requested') {
            echo "<li class='list-group-item'><label>" . $freund->getUsername() . "</label>";
            echo "<form action='friends.php' method='post'>";
            echo "<input type='hidden' name='friendToProcess' value='" . $freund->getUsername() . "' />";
            echo "<input type='submit' class='positive' name='action' value='accept-" . $freund->getUsername() . "' />";
            echo "<input type='submit' class='danger' name='action' value='reject-" . $freund->getUsername() . "' />";
            echo "</form></li>";
          }
        }
        ?>
      </ul>
    </div>
  </header>
  <?php
  foreach ($freunde as $freund) {
    if ($freund->getStatus() == 'requested') {
      echo "<div class='modal fade' id='acceptModal" . $freund->getUsername() 
        . "' tabindex='-1' aria-labelledby='acceptModalLabel' aria-hidden='true'>";
      echo "<div class='modal-dialog'>";
      echo "<div class='modal-content'>";
      echo "<div class='modal-header'>";
      echo "<h5 class='modal-title' id='acceptModalLabel'>Accept Friend Request</h5>";
      echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
      echo "</div>";
      echo "<div class='modal-body'>";
      echo "Do you want to accept the friend request from " . $freund->getUsername() . "?";
      echo "</div>";
      echo "<div class='modal-footer'>";
      echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>";
      echo "<form action='friends.php' method='post'>";
      echo "<input type='hidden' name='friendToProcess' value='" . $freund->getUsername() . "' />";
      echo "<button type='submit' class='btn btn-success' name='action' value='accept-" 
        . $freund->getUsername() . "'>Accept</button>";
      echo "</form>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
    }
  }
  ?>

  <hr />
  <div>
    <form action="friends.php" method="post">
      <input type="text" id="addToList" name="addToList" placeholder="Add Friend to List" 
        onkeyup="keyup(this)" class="adder" list="namen" />
      <datalist id="namen"></datalist>
      <input type="submit" name="action" value="add-friend" class="neutral" />
    </form>
  </div>

  <script src="./main.js"></script>
  <script src="../Loesung_3/friends.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>