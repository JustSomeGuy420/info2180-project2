document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("add").addEventListener("click", (e) => {
        e.preventDefault();
        window.location.href = "new_user.php"
    })

    fetch("../ajax/get_users.php")
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById("usersTable");
            tbody.innerHTML = "";

            if (!data.success || data.users.length === 0) {
                tbody.innerHTML = "<tr><td>No users found.</td></tr>";
                return;
            }

            data.users.forEach(user => {
                const row = document.createElement("tr");

                row.innerHTML = `
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.role}</td>
                    <td>${user.created_at}</td>
                `;

                tbody.appendChild(row);
            });
        })
        .catch(() => {
            document.getElementById("usersTable").innerHTML =
                "<tr><td>Failed to load users.</td></tr>";
        });
});
