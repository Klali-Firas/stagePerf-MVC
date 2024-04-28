<?php
session_start();

if (isset($_SESSION['valid'])) {
    session_destroy();
}


include_once "../vue/confirmation.php";
?>