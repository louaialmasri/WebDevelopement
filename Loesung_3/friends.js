window.setInterval(() => {
  loadFriends();
}, 2000);

function showList(prefix) {
  let allUsers = Array.from(document.querySelectorAll("#allUsers")).map(el => el.value);
  document.querySelector("#namen").innerHTML = "";
  prefix = prefix.toLowerCase();
  allUsers.forEach((val) => {
        if (prefix === " " || val.toLowerCase().startsWith(prefix)) {
          let option = document.createElement("option");
          option.setAttribute("value", val);
          document.querySelector("#namen").appendChild(option);
        }
      });
}

function keyup(input) {
  const prefix = input.value;
  showList(prefix);
}

function loadFriends(){
  fetch(
    "http://localhost/Testat4/Loesung_4/ajax_load_friends.php",
    {
      method: "GET",
      headers: {
        "Content-type": "application/json"
      }
    }
  )
  .then(response => {
    if(response.ok){
      return response.json();
    } else{
      throw new Error("Anfrage fehlgeschlagen" + response.status);
    }
  })
  .catch(error =>{
    console.error(error);
  });
}

// let benutzer = [];

// async function initNames(prefix) {
//   let vornamen = [];
//   await fetch(
//     "https://online-lectures-cs.thi.de/chat/63175f31-934e-42cb-a27b-9678bf16e83b/friend",
//     {
//       method: "GET",
//       headers: {
//         "Content-type": "application/json",
//         "Authorization":
//           "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiSmVycnkiLCJpYXQiOjE2OTk3NzU3MzJ9.SYeYAVQSE3ANl146QSqwsjoqP416AAi0JYb4AN0iyy0",
//       },
//     }
//   )
//     .then((response) => response.json())
//     .then((liste) =>
//       liste.forEach((eintrag) =>
//         eintrag.username !== "Tom"
//           ? vornamen.push(eintrag.username)
//           : console.log("bereits freund")
//       )
//     );
//   const datalist = document.querySelector("#namen");

//   //datalist leeren
//   datalist.innerHTML = "";
//   prefix = prefix.toLowerCase();
//   // iterieren über namen Array
//   vornamen.forEach((val) => {
//     if (prefix === " " || val.toLowerCase().startsWith(prefix)) {
//       let option = document.createElement("option");
//       option.setAttribute("value", val);
//       datalist.appendChild(option);
//     }
//   });
// }

// /**
//  * Behandle 'keyup'-Ereignis:
//  * hole aktuelle Eingabe und initialisiere "datalist"
//  */


// function loadFriends() {
//   fetch(
//     "https://online-lectures-cs.thi.de/chat/63175f31-934e-42cb-a27b-9678bf16e83b/friend",
//     {
//       method: "GET",
//       headers: {
//         "Content-type": "application/json"
//       },
//     }
//   )
//     .then((response) => response.json())
//     .then((data) => {
//       const acceptedFriends = data.filter(
//       (friend) => friend.status === "accepted"
//       );
//       const requestedFriends = data.filter(
//         (friend) => friend.status === "requested"
//       );
//       updateFriendsList(acceptedFriends);
//       updateRequestsList(requestedFriends);
//     })
//     .catch((error) =>
//       console.error("Fehler beim Laden der Freundesliste:", error)
//     );
// }

// function loadRequests() {
//   fetch(
//     "https://online-lectures-cs.thi.de/chat/63175f31-934e-42cb-a27b-9678bf16e83b/friend",
//     {
//       method: "GET",
//       headers: {
//         "Content-type": "application/json"
//       },
//     }
//   )
//     .then((response) => response.json())
//     .then((data) => {
//       const requestedFriends = data.filter(
//         (friend) => friend.status === "requested"
//       );
//       updateRequestsList(requestedFriends);
//     });
// }

// function updateFriendsList(acceptedFriends) {
//   const friendsList = document.querySelector(".freunde");
//   friendsList.innerHTML = "";

//   acceptedFriends.forEach((friend) => {
//     const listItem = document.createElement("li");
//     const link = document.createElement("a");
//     link.className = "akzeptierteFreunde";
//     link.href = "chat.php?friend=" + friend.username; // stimmt das ?
//     link.classList.add("freund");
//     link.textContent = `${friend.username} (${friend.unread})`;
//     listItem.appendChild(link);
//     friendsList.appendChild(listItem);
//   });
// }

// function updateRequestsList(requestedFriends) {
//   const requestsHeader = document.querySelector(".header h2");
//   const requestsList = document.querySelector(".requests");
//   requestsList.innerHTML = "";

//   if (requestedFriends.length > 0) {
//     requestsHeader.style.display = "block";
//   } else {
//     requestsHeader.style.display = "none";
//   }

//   requestedFriends.forEach((friend) => {
//     const label = document.createElement("label");
//     label.innerHTML = `<strong> ${friend.username} </strong> wants to be your friend.`;
//     const form = document.createElement("form");
//     form.action = "friends.php";
//     const acceptButton = document.createElement("input");
//     acceptButton.type = "submit";
//     acceptButton.value = "Accept";
//     acceptButton.classList.add("positive");
//     const rejectButton = document.createElement("input");
//     rejectButton.type = "submit";
//     rejectButton.value = "Reject";
//     rejectButton.classList.add("danger");
//     form.appendChild(acceptButton);
//     form.appendChild(rejectButton);
//     requestsList.appendChild(label);
//     requestsList.appendChild(form);
//   });
// }

// function hinzufuegen() {
//   let url =
//     "https://online-lectures-cs.thi.de/chat/63175f31-934e-42cb-a27b-9678bf16e83b/friend";
//   let freundname = document.querySelector("#addToList").value;
//     let data = {
//     username: freundname,
//   };
//   let jsonString = JSON.stringify(data);
//   console.log(jsonString);
//   fetch(url, {
//     method: "POST",
//     headers: {
//       "Content-type": "application/json"
//     },
//     body: jsonString,
//   })
//     .then((response) => {
//       if (response.status == 204) {
//         document.querySelector("#addToList").value = "";
//         console.log("Requested...");
//       } else {
//         console.error("Fehler beim Hinzufügen des Freundes. Statuscode: ", resposnse.status);
//       }
//     })
//     .catch((error) => console.error("Error:", error));
// }
