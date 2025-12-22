document.addEventListener("DOMContentLoaded", () => {
    loadUsers();

    document.getElementById("contactForm").addEventListener("submit", submitForm);
});

function loadUsers() {
    fetch("../ajax/get_users_for_select.php")
        .then(res => res.json())
        .then(data => {
            const select = document.getElementById("assignedTo");
            select.innerHTML = '<option value="">Select User</option>';

            data.users.forEach(user => {
                const opt = document.createElement("option");
                opt.value = user.id;
                opt.textContent = user.name;
                select.appendChild(opt);
            });
        });
}

function submitForm(e) {
    e.preventDefault();

    const formData = new FormData(e.target);

    fetch("../ajax/create_contact.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        const msg = document.getElementById("message");
        msg.textContent = data.message;
        msg.style.color = data.success ? "green" : "red";

        if (data.success) {
            e.target.reset();
        }
    })
    .catch(() => {
        document.getElementById("message").textContent = "Server error.";
    });
}
