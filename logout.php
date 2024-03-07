<?php
session_start();
//destroy session
session_destroy();
//unset cookies
setcookie('user_login', '', 0, "/");

header("Location: index.php");
?>