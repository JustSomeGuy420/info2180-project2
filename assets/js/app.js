// Load content when sidebar links clicked
document.addEventListener("click", function(e) {
  if (e.target.matches(".load-page")) {
    e.preventDefault();
    let page = e.target.getAttribute("data-page");
    let param = e.target.getAttribute("data-param");
    loadPage(page, param);
  }

  // Assign button handler
  if (e.target.id === "assignBtn") {
    c_id = e.target.getAttribute("data-contact-id");
    assignContact(c_id);
  }

  // Switch type button
  if (e.target.id === "switchTypeBtn") {
    c_id = e.target.getAttribute("data-contact-id");
    switchType(c_id);
  }

  // Add note button
  if (e.target.id === "addNoteBtn") {
    c_id = e.target.getAttribute("data-contact-id");
    addNote(c_id);
  }
});

document.addEventListener("submit", e => {
  if (e.target.id === "loginForm") {
    e.preventDefault();
    const formData = new FormData(e.target);

    fetch("ajax/login.php", {
      method: "POST",
      body: formData
    })
    .then(res => res.text())
    .then(data => {
      if (data.trim() === "success") {
        window.location = "dashboard.php";
      } else {
        document.getElementById("loginMessage").innerText = data;
      }
    });
  }
});

function loadPage(page, param = "") {
  fetch("ajax/load_page.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: `page=${encodeURIComponent(page)}&param=${encodeURIComponent(param)}`
  })
  .then(res => res.text())
  .then(data => {
    document.getElementById("content-area").innerHTML = data;
  });
}

function assignContact(c_id) {
  fetch("ajax/assign_contact.php", {
    method: "POST",
    body: new URLSearchParams({ contact_id: c_id })
  })
  .then(r => r.text())
  .then(data => {
    document.getElementById("assigned_to").innerText = data;
  });
}

function switchType(c_id) {
  const current = document.getElementById("contact_type").innerText;

  fetch("ajax/switch_type.php", {
    method: "POST",
    body: new URLSearchParams({ contact_id: c_id, current_type: current })
  })
  .then(r => r.text())
  .then(() => loadPage('view_details.php', c_id));
}

function addNote(c_id) {
  const text = document.getElementById("note_text").value;

  fetch("ajax/add_note.php", {
    method: "POST",
    body: new URLSearchParams({ contact_id: c_id, comment: text })
  })
  .then(r => r.text())
  .then(() => loadPage('view_details.php', c_id));
}