window.setInterval(() => {
  loadChat();
}, 1000);

let lastMsgTime = 0;

function getChatpartner() {
  const url = new window.URL(window.location.href); // Access the query parameters using searchParams
  const queryParams = url.searchParams; // Retrieve the value of the "friend" parameter
  const friendValue = queryParams.get("friend");
  return friendValue;
}

function loadChat() {
  let friendsname = getChatpartner();
  document.querySelector("#chatPartnerName").innerHTML =
    "Chat with " + friendsname;
  fetch(
    "http://localhost/Testat4/Loesung_4/ajax_load_messages.php?to=" +
      friendsname,
    {
      method: "GET",
      headers: {
        "Content-type": "application/json"
        }
    }
  )
    .then((response) => {
      if (response.ok) {
        return response.json();
      } else {
        throw new Error(`Fehler beim Laden des Chats: ${response.status}`);
      }
    })
    .then((message) =>
      message.length > 0
        ? message.forEach((value) => {
            if (value.time > lastMsgTime) {
              let date = new Date(value.time * 1000);
              let hours = date.getHours();
              let minutes = "0" + date.getMinutes();
              let seconds = "0" + date.getSeconds();
              let formattedTime =
                hours + ":" + minutes.substr(-2) + ":" + seconds.substr(-2);
              document.querySelector(".freunde").innerHTML +=
                "<div class='message'>" +
                "<p class='text'>" +
                value.from +
                ": " +
                value.msg +
                "</p>" +
                "<p class='timestamp'>" +
                formattedTime +
                "</p>" +
                "<br>" +
                "</div>";
              lastMsgTime = value.time;
            }
          })
        : console.log("Keine Nachrichten")
    );
}

function sendMessage() {
  const friendsname = getChatpartner();
  const nachricht = document.querySelector("#nachricht").value;
  const data = {
    msg: nachricht,
    to: friendsname,
  };

  fetch(
    "http://localhost/Testat4/Loesung_4/ajax_send_message.php",
    {
      method: "POST",
      headers: {
        "Content-type": "application/json"
      },
      body: JSON.stringify(data),
    }
  )
    .then((response) => {
      console.log(JSON.stringify(data));
      if (response.ok) {
        loadChat();
        document.querySelector("#nachricht").value = "";
      } else {
        console.error(
          `Fehler beim Senden der Nachricht: ${response.status} - ${response.statusText}`
        );
      }
    })
    .catch((error) =>
      console.error("Fehler beim Senden der Nachricht:", error)
    );
}
