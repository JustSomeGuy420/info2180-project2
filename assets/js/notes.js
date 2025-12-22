document.addEventListener("DOMContentLoaded", () => {
    loadNotes();

    document.getElementById("noteForm").addEventListener("submit", addNote);
});

function loadNotes() {
    fetch(`../ajax/get_notes.php?contact_id=${CONTACT_ID}`)
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById("notesList");
            container.innerHTML = "";

            if (!data.notes.length) {
                container.innerHTML = "<p>No notes yet.</p>";
                return;
            }

            data.notes.forEach(note => {
                const div = document.createElement("div");
                div.style.border = "1px solid #ccc";
                div.style.padding = "10px";
                div.style.marginBottom = "10px";

                div.innerHTML = `
                    <p>${note.comment}</p>
                    <small>
                        Created by ${note.author} on ${note.created_at}
                    </small>
                `;

                container.appendChild(div);
            });
        });
}

function addNote(e) {
    e.preventDefault();

    const formData = new FormData(e.target);
    formData.append("contact_id", CONTACT_ID);

    fetch("../ajax/add_note.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            e.target.reset();
            loadNotes();
        }
    });
}
