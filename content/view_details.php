<?php
require_once '../config.php';

$contact_id = $param ?? null;

// Get contact info
$stmt = $conn->prepare("
    SELECT c.*, u.firstname AS creator_first, u.lastname AS creator_last, 
           a.firstname AS assigned_first, a.lastname AS assigned_last
    FROM contacts c
    LEFT JOIN users u ON c.created_by = u.id
    LEFT JOIN users a ON c.assigned_to = a.id
    WHERE c.id = ?
");

$stmt->bind_param("i", $contact_id);
$stmt->execute();
$contact = $stmt->get_result()->fetch_assoc();

// Get notes
$noteStmt = $conn->prepare("
    SELECT n.*, u.firstname, u.lastname
    FROM notes n 
    JOIN users u ON n.created_by = u.id
    WHERE contact_id = ?
    ORDER BY created_at DESC
");
$noteStmt->bind_param("i", $contact_id);
$noteStmt->execute();
$notes = $noteStmt->get_result();
?>

<h2>Contact Details</h2>

<p><strong>Title:</strong> <?= $contact['title'] ?></p>
<p><strong>Name:</strong> <?= $contact['firstname'] . " " . $contact['lastname'] ?></p>
<p><strong>Email:</strong> <?= $contact['email'] ?></p>
<p><strong>Telephone:</strong> <?= $contact['telephone'] ?></p>
<p><strong>Company:</strong> <?= $contact['company'] ?></p>

<p><strong>Type:</strong> <span id="contact_type"><?= $contact['type'] ?></span></p>
<p><strong>Assigned To:</strong> 
   <span id="assigned_to">
     <?= $contact['assigned_first'] ? $contact['assigned_first'] . " " . $contact['assigned_last'] : "Unassigned" ?>
   </span>
</p>

<button id="assignBtn" data-cid="<?= $contact_id ?>">Assign to me</button>
<button id="switchTypeBtn" data-contact-id="<?= $contact_id ?>">Switch Type</button>

<hr>
<h3>Notes</h3>
<div id="notes">
<?php while($note = $notes->fetch_assoc()): ?>
  <div>
    <p><strong><?= $note['firstname']." ".$note['lastname'] ?>:</strong> <?= $note['comment'] ?></p>
    <small><?= $note['created_at'] ?></small>
    <hr>
  </div>
<?php endwhile; ?>
</div>

<textarea id="note_text" placeholder="Add a note..."></textarea><br>
<button id="addNoteBtn" data-contact-id="<?= $contact_id ?>">Add Note</button>

