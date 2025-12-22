document.getElementById("loginForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("../ajax/login.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            window.location.href = "dashboard.php";
        } else {
            document.getElementById("error").textContent = data.message;
        }
    })
    .catch(() => {
        document.getElementById("error").textContent = "Server error.";
    });
});
