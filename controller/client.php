<?php
require_once 'isAuth.php';

ob_start();


include_once '../model/Client/CRUDClient.php';

$CRUD_Client = new CRUDClient();

if (isset($_GET['id'])) {
    $client = $CRUD_Client->getClient($_GET['id']);
}
$clients = $CRUD_Client->getClient();


if (isset($_POST['modifier'])) {

    $client = new Client($client['id'], $_POST['nom'], $_POST['prenom'], $_POST['telephone'], $_POST['adresse']);

    $CRUD_Client->modifClient($client);

}
if (isset($_POST['ajouter'])) {
    $client = new Client(0, $_POST['nom'], $_POST['prenom'], $_POST['telephone'], $_POST['adresse']);

    $CRUD_Client->ajoutClient($client);
}
if (isset($_GET['delete']) and isset($_GET['id'])) {
    $CRUD_Client->suppClient($_GET['id']);

}

include_once "../vue/client.php";

?>