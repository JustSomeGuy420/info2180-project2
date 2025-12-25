<?php require_once "auth.php"; ?>

<ul class="navbar">
  <li><a href="#" onclick="window.location.href='dashboard.php'">Home</a></li>
  <li><a href="#" onclick="window.location.href='new_contact.php'">New Contact</a></li>
  <?php if (is_admin()): ?>
    <li><a href="#" onclick="window.location.href='users.php'">Users</a></li>
  <?php endif; ?>
  <li style="float:right"><a href="logout.php">Logout</a></li>
</ul>
