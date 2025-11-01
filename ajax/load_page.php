<?php
$page = "../content/" . $_POST['page'];
if (file_exists($page)) {
    include $page;
} else {
    echo "Page not found.";
}
