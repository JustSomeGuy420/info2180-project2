<?php require_once "auth.php"; ?>

<ul class="sidebar">
  <li><a href="dashboard.php">Home</a></li>
  <li><a href="new_contact.php">New Contact</a></li>
  <?php if (is_admin()): ?>
    <li><a href="users.php">Users</a></li>
  <?php endif; ?>
  <li style="float:right"><a href="logout.php">Logout</a></li>
</ul>
