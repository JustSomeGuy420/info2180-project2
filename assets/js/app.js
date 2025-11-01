// Load content when sidebar links clicked
document.querySelectorAll(".load-page").forEach(link => {
  link.addEventListener("click", e => {
    e.preventDefault();
    const page = link.getAttribute("data-page");

    fetch("ajax/load_page.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "page=" + page
    })
    .then(res => res.text())
    .then(data => {
      document.getElementById("content-area").innerHTML = data;
    });
  });
});

document.addEventListener("submit", e => {
  if (e.target.id === "profileForm") {
    e.preventDefault();
    const formData = new FormData(e.target);

    fetch("ajax/update_profile.php", {
      method: "POST",
      body: formData
    })
    .then(res => res.text())
    .then(msg => {
      document.getElementById("updateMsg").innerText = msg;
    });
  }
});
