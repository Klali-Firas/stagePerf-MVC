<?php
session_start();
if (!isset($_SESSION['valid'])) {
    header('Location: seConnecter.php?error=1');
    exit;
}
?>