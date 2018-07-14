<?php
require_once 'header.php';
unset ($_SESSION["uname"]);
session_destroy();
redirect("login.php");
?>
