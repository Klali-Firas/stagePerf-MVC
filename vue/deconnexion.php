

<?php
session_start();

if(isset($_SESSION['valid'])) {
    session_destroy();
    header("Location: ../confirmation.php");
    exit; 
} else {
    header("Location: ../confirmation.php");
    exit; 
}
?>
