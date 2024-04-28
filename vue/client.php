<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form method="post">
                <label for="nom">Nom</label>
                <input value="<?= isset($_GET['id']) ? $client['nom'] : "" ?>" type="text" name="nom" id="nom"
                    placeholder="Veuillez saisir le nom">
                <input value="<?= isset($_GET['id']) ? $client['id'] : "" ?>" type="hidden" name="id" id="id">

                <label for="prenom">Prénom</label>
                <input value="<?= isset($_GET['id']) ? $client['prenom'] : "" ?>" type="text" name="prenom" id="prenom"
                    placeholder="Veuillez saisir le prénom">

                <label for="telephone">Numéro de Téléphone</label>
                <input value="<?= isset($_GET['id']) ? $client['telephone'] : "" ?>" type="text" name="telephone"
                    id="telephone" placeholder="Veuillez saisir le Numéro de Téléphone">

                <label for="adresse">Adresse</label>
                <input value="<?= isset($_GET['id']) ? $client['adresse'] : "" ?>" type="text" name="adresse"
                    id="adresse" placeholder="Veuillez saisir l'adresse">

                <button type="submit"
                    name="<?= isset($_GET['id']) ? 'modifier' : 'ajouter' ?>"><?= !empty($_GET['id']) ? "Modifier" : "Ajouter" ?></button>

                <?php
                if (!empty($_SESSION['message'])) {

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
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Action</th>
                </tr>
                <?php


                if (isset($clients) && is_array($clients)) {
                    foreach ($clients as $key => $value) {
                        ?>
                        <tr>
                            <td><?= $value['nom'] ?></td>
                            <td><?= $value['prenom'] ?></td>
                            <td><?= $value['telephone'] ?></td>
                            <td><?= $value['adresse'] ?></td>
                            <td><a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt'></i></a>
                                <a href="?id=<?= $value['id'] ?>&delete=true"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client?')"><i
                                        class='bx bx-trash'></i></a>
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

$contenu = ob_get_clean();

include_once "layout.php";

?>