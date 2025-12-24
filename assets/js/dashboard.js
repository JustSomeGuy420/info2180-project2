document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("add").addEventListener("click", (e) => {
        e.preventDefault();
        window.location.href = "new_contact.php"
    })

    loadContacts("all");

    document.querySelectorAll("button[data-filter]").forEach(btn => {
        btn.addEventListener("click", () => {
            loadContacts(btn.dataset.filter);
        });
    });
});

function loadContacts(filter) {
    fetch(`../ajax/get_contacts.php?filter=${filter}`)
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById("contactsTable");
            tbody.innerHTML = "";

            if (!data.success || data.contacts.length === 0) {
                tbody.innerHTML = "<tr><td colspan='4'>No contacts found.</td></tr>";
                return;
            }

            data.contacts.forEach(contact => {
                const row = document.createElement("tr");

                row.innerHTML = `
                    <td><a href="contact.php?id=${contact.id}">${contact.name}</a></td>
                    <td>${contact.email}</td>
                    <td>${contact.company}</td>
                    <td>${contact.type}</td>
                    <td><a href="contact.php?id=${contact.id}">View</a></td>
                `;

                tbody.appendChild(row);
            });
        })
        .catch(() => {
            document.getElementById("contactsTable").innerHTML =
                "<tr><td colspan='4'>Failed to load contacts.</td></tr>";
        });
}
