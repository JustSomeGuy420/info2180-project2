document.getElementById("userForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("../ajax/create_user.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        const msg = document.getElementById("message");
        msg.textContent = data.message;
        msg.style.color = data.success ? "green" : "red";

        if (data.success) {
            this.reset();
        }
    });
});
