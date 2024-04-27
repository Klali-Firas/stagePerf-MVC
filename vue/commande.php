<?php
include 'entete.php';

if (!empty($_GET['id'])) {
    $article = getCommande($_GET['id']);
}

?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifCommande.php" : "../model/ajoutCommande.php" ?>" method="post">
                <input value="<?= !empty($_GET['id']) ? $article['id'] : "" ?>" type="hidden" name="id" id="id">

                <label for="id_article">Article</label>
                <select onchange="setPrix()" name="id_article" id="id_article">
                <option disabled selected>Sélectionnez un article</option> <!-- Option désactivée et sélectionnée par défaut -->

                    <?php
                    $articles = getArticle();
                    if (!empty($articles) && is_array($articles)) {
                        foreach ($articles as $key => $value) {
                            ?>
                            <option data-prix="<?= $value['prix_unitaire'] ?>" value="<?= $value['id'] ?>"><?= $value['nom_article']." - ".$value['quantite']." disponible(s)" ?></option>
                            <?php
                        }
                    }
                    ?> 
                </select>

                <label for="id_fournisseur">Fournisseur</label>
                <select name="id_fournisseur" id="id_fournisseur">
                <option disabled selected>Sélectionnez un fournissuer</option> <!-- Option désactivée et sélectionnée par défaut -->
                    <?php
                    $clients = getFournisseur();
                    if (!empty($clients) && is_array($clients)) {
                        foreach ($clients as $key => $value) {
                            ?>
                            <option value="<?= $value['id'] ?>"><?= $value['nom']." ".$value['prenom'] ?></option>
                            <?php
                        }
                    }
                    ?> 
                </select>

                <label for="quantite">Quantité</label>
                <input onkeyup="setPrix()" value="<?= !empty($_GET['id']) ? $article['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="Veuillez saisir la quantité">

                <label for="prix">Prix</label>
                <input value="<?= !empty($_GET['id']) ? $article['prix'] : "" ?>" type="number" name="prix" id="prix" placeholder="Veuillez saisir le prix">

                <button type="submit"><?= !empty($_GET['id']) ? "Modifier" : "Ajouter" ?></button>

                <?php
                if (!empty($_SESSION['message']['text'])) {
                    ?>
                    <div id="alert" class="alert <?= $_SESSION['message']['type'] ?>">
                        <?= $_SESSION['message']['text'] ?>
                    </div>
                    <?php    
                    unset($_SESSION['message']);
                }
                ?>
            </form>
        </div>
        <div class="box">
            <table class="mtable">
                <tr>
                    <th>Article</th>
                    <th>Fournisseur</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php
                $vente = getCommande();

                if(!empty($vente) && is_array($vente)){
                    foreach ($vente as $key => $value) {
                        ?>
                        <tr>
                            <td><?= $value['nom_article'] ?></td>
                            <td><?= $value['nom']." ".$value['prenom'] ?></td>
                            <td><?= $value['quantite'] ?></td>
                            <td><?= $value['prix'] ?></td>
                            <td><?= date('d/m/y h:i:s', strtotime($value['date_commande'])) ?></td>
                            <td>
                                <a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt'></i></a>
                                <a href="recuCommande.php?id=<?= $value['id'] ?>"><i class='bx bx-receipt'></i></a>
                                <a onclick="annuleCommande(<?= $value['id'] ?>,
                                                        <?= $value['idArticle'] ?>,
                                                        <?= $value['quantite'] ?>)"
                                    style="color: red;"> <i class='bx bx-stop-circle'></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>
</section>

<?php
include 'pied.php';
?>

<script>
    function annuleCommande(idCommande, idArticle, quantite) {
        if (confirm("Voulez-vous vraiment annuler cette commande ?")) {
            window.location.href = "../model/annuleCommande.php?idCommande=" + idCommande +
                "&idArticle=" + idArticle + "&quantite=" + quantite;
        }
    }

    function setPrix() {
        var article = document.querySelector('#id_article');
        var quantite = document.querySelector('#quantite');
        var prix = document.querySelector('#prix');

        var prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix');

        prix.value = Number(quantite.value) * Number(prixUnitaire);
    }
</script>
