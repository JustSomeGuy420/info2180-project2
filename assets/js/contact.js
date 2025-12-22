document.addEventListener("DOMContentLoaded", () => {
    loadContact();

    document.getElementById("assignBtn").addEventListener("click", assignToMe);
    document.getElementById("typeBtn").addEventListener("click", switchType);
});

function loadContact() {
    fetch(`../ajax/get_contact.php?id=${CONTACT_ID}`)
        .then(res => res.json())
        .then(data => {
            if (!data.success) return;

            const c = data.contact;

            document.getElementById("contactDetails").innerHTML = `
                <p><strong>Name:</strong> ${c.name}</p>
                <p><strong>Email:</strong> ${c.email}</p>
                <p><strong>Telephone:</strong> ${c.telephone}</p>
                <p><strong>Company:</strong> ${c.company}</p>
                <p><strong>Type:</strong> ${c.type}</p>
                <p><strong>Assigned To:</strong> ${c.assigned_name}</p>
                <p><strong>Created By:</strong> ${c.created_by}</p>
                <p><strong>Date Created:</strong> ${c.created_at}</p>
            `;

            document.getElementById("typeBtn").style.display = "inline-block";

            if (!c.assigned_to) {
                document.getElementById("assignBtn").style.display = "inline-block";
            }
        });
}

function assignToMe() {
    fetch("../ajax/assign_contact.php", {
        method: "POST",
        body: new URLSearchParams({ id: CONTACT_ID })
    }).then(() => loadContact());
}

function switchType() {
    fetch("../ajax/update_contact_type.php", {
        method: "POST",
        body: new URLSearchParams({ id: CONTACT_ID })
    }).then(() => loadContact());
}
