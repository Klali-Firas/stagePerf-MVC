<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form method="post">
                <input value="<?= !empty($_GET['id']) ? $article['id'] : "" ?>" type="hidden" name="id" id="id">

                <label for="id_article">Article</label>
                <select onchange="setPrix()" name="id_article" id="id_article">
                    <option disabled <?= !isset($_GET['id']) ? 'selected' : '' ?>>Sélectionnez un article</option>
                    <!-- Option désactivée et sélectionnée par défaut -->

                    <?php
                    if (!empty($articles) && is_array($articles)) {
                        foreach ($articles as $key => $value) {
                            ?>
                            <option data-prix="<?= $value['prix_unitaire'] ?>" value="<?= $value['id'] ?>" <?= isset($_GET['id']) && $article['nom_article'] == $value['nom_article'] ? 'selected' : '' ?>>
                                <?= $value['nom_article'] . " - " . $value['quantite'] . " disponible(s)" ?>
                            </option>
                            <?php
                        }
                    }
                    ?>
                </select>

                <label for="id_client">Client</label>
                <select name="id_client" id="id_client">
                    <option disabled <?= !isset($_GET['id']) ? 'selected' : '' ?>>Sélectionnez un client</option>
                    <!-- Option désactivée et sélectionnée par défaut -->

                    <?php
                    if (!empty($clients) && is_array($clients)) {
                        foreach ($clients as $key => $value) {
                            ?>
                            <option value="<?= $value['id'] ?>" <?= isset($_GET['id']) && $article['telephone'] == $value['telephone'] ? 'selected' : '' ?>>
                                <?= $value['nom'] . " " . $value['prenom'] ?>
                            </option>
                            <?php
                        }
                    }
                    ?>
                </select>

                <label for="quantite">Quantité</label>
                <input oninput="setPrix()" value="<?= !empty($_GET['id']) ? $article['quantite'] : "" ?>" type="number"
                    name="quantite" id="quantite" placeholder="Veuillez saisir la quantité">

                <label for="prix">Prix</label>
                <input value="<?= !empty($_GET['id']) ? $article['prix'] : "" ?>" type="number" name="prix" id="prix"
                    placeholder="Veuillez saisir le prix" readonly>

                <button type="submit"
                    name="<?= isset($_GET['id']) ? 'modifier' : 'ajouter' ?>"><?= !empty($_GET['id']) ? "Modifier" : "Ajouter" ?></button>

                <?php
                if (!empty($_SESSION['message']['text'])) {
                    ?>
                    <div class="alert <?= $_SESSION['message']['type'] ?>">
                        <?= $_SESSION['message']['text'] ?>
                    </div>
                    <?php
                }
                unset($_SESSION['message']);
                ?>
            </form>
        </div>
        <div class="box">
            <table class="mtable">
                <tr>
                    <th>Article</th>
                    <th>Client</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php

                if (!empty($ventes) && is_array($ventes)) {
                    foreach ($ventes as $key => $value) {
                        ?>
                        <tr>
                            <td><?= $value['nom_article'] ?></td>
                            <td><?= $value['nom'] . " " . $value['prenom'] ?></td>
                            <td><?= $value['quantite'] ?></td>
                            <td><?= $value['prix'] ?></td>
                            <td><?= date('d/m/y h:i:s', strtotime($value['date_vente'])) ?></td>
                            <td>
                                <a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt'></i></a>
                                <a href="recuVente.php?id=<?= $value['id'] ?>"><i class='bx bx-receipt'></i></a>
                                <a href="?id=<?= $value['id'] . '&idArticle=' . $value['idArticle'] . '&quantite=' . $value['quantite'] ?>&delete=true"
                                    style="color: red;" onclick="return confirm('Voulez-vous vraiment annuler cette vente ')">
                                    <i class='bx bx-stop-circle'></i></a>
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



<!-- Script to hide the alert message when clicked elsewhere on the page -->

<script>


    function setPrix() {
        var article = document.querySelector('#id_article');
        var quantite = document.querySelector('#quantite');
        var prix = document.querySelector('#prix');

        var prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix');

        prix.value = Number(quantite.value) * Number(prixUnitaire);
    }
</script>

<?php
$contenu = ob_get_clean();
include_once "layout.php";
?>