<?php
session_start();

include_once "../model/Admin/CRUDAdmin.php";

$CrudAdmin = new CRUDAdmin();

if (isset($_SESSION['valid'])) {
    header("Location: dashboard.php");
    exit;
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $admin = new Admin(null, $email, $password);
    $result = $CrudAdmin->login($admin);

    if ($result) {
        $_SESSION['valid'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $errorMessage = "Email ou mot de passe incorrect";
    }


}


include_once "../vue/connexion.php";
?>