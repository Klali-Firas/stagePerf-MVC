<div class="home-content">

    <button class="hidden-print" id="btnPrint" style="position : relative; left : 45%;"> <i
            class='bx bx-printer'></i>Imprimer</button>

    <div class="page">
        <div class="cote-a-cote">
            <h2>TRANSTU STOCK</h2>

            <div>
                <p>Reçu Commande N° #: <?= $commande['id'] ?></p>
                <p>Date: <?= date('d/m/y h:i:s', strtotime($commande['date_commande'])) ?></p>
            </div>
        </div>

        <div class="cote-a-cote" style="width : 50%">
            <p>Nom :</p>
            <p><?= $commande['nom'] . " " . $commande['prenom'] ?></p>
        </div>

        <div class="cote-a-cote" style="width : 50%">
            <p>Tel :</p>
            <p><?= $commande['telephone'] ?></p>
        </div>
        <div class="cote-a-cote" style="width : 50%">
            <p>Adresse :</p>
            <p><?= $commande['adresse'] ?></p>
        </div>

        <br>

        <table class="mtable">
            <tr>
                <th>Designation</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Prix total</th>
            </tr>

            <tr>
                <td><?= $commande['nom_article'] ?></td>
                <td><?= $commande['quantite'] ?></td>
                <td><?= $commande['prix_unitaire'] ?></td>
                <td><?= $commande['prix'] ?></td>
            </tr>
        </table>
    </div>

</div>
</section>

<?php
$contenu = ob_get_clean();
require_once "layout.php";
?>

<script>

    var btnPrint = document.querySelector('#btnPrint');
    btnPrint.addEventListener(
        "click", () => { window.print(); }
    ); 
</script>