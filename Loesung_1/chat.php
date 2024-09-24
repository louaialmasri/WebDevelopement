<?php
require "../Loesung_4/start.php";

if(isset($_SESSION["user"]) && $_SESSION["user"] != "") {
  $user = $_SESSION["user"];
  if(!(isset($_GET["friend"]) && $_GET["friend"] != "")){
    header("location: friends.php");
    exit();
  }
}else{
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <title>Chat</title>
</head>
<body>
  <header class="header">
    <h1 id="chatPartnerName">Chat with</h1>
    <div>
      <a href="friends.php"> <i class="fas fa-arrow-left"></i> Back </a>
      |
      <a href="profile.php" class="selected">
        <i class="fas fa-user"></i> Profile
      </a>
      |
      <button id="removeFriendButton" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#removeFriendModal">
        <i class="fas fa-user-times"></i> Remove Friend
      </button>

      <div>
      </div>
      <hr />
    </header>
    <br />
    <br />
    <div class="freunde"></div>

    <!-- Modal für das Entfernen eines Freundes -->
    <div class="modal fade" id="removeFriendModal" tabindex="-1" 
      aria-labelledby="removeFriendModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="removeFriendModalLabel">Remove Friend</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to remove this friend?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <form action="friends.php" method="post">
              <?php
                $friendRemover = $_GET["friend"];
                echo '<input type="hidden" name="friendToRemove" value ="'.$friendRemover.'">';
              ?>
              <button type="submit" class="btn btn-danger" name="action" value="remove-friend">Remove Friend</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="chatsend">
      <div class="input-group">
        <input type="text" placeholder="New Message" class="form-control" id="nachricht"/>
        <button class="btn btn-primary" onclick="sendMessage()">Send</button>
      </div>
    </div>

    <script src="./main.js"></script>
    <script src="../Loesung_3/chat.js"></script>
    <script src="../Loesung_5/bootstrap.bundle.js"></script>
    
    <script>
      // JavaScript, um das Modal manuell zu öffnen
      document.getElementById('removeFriendButton').addEventListener('click', function() {
        var myModal = new bootstrap.Modal(document.getElementById('removeFriendModal'));
        myModal.show();
      });
      // JavaScript, um nach dem Schließen des Modals auf chat.php zurückzuleiten
      document.getElementById('removeFriendModal').addEventListener('hidden.bs.modal', function () {
        window.location.href = 'chat.php?friend=<?php echo $_GET["friend"]; ?>';
      });
    </script>
  </body>
</html>