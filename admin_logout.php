<?php
session_start();
// Destroy session and redirect to home page
session_unset();
session_destroy();
header('Location: home.php');
exit();
