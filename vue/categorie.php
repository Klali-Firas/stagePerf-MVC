<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form method="post">
                <label for="libelle_categorie">Libellé</label>
                <input value="<?= !empty($_GET['id']) ? $categorie['libelle_categorie'] : "" ?>" type="text"
                    name="libelle_categorie" id="libelle_categorie" placeholder="Veuillez saisir le nom">
                <input value="<?= !empty($_GET['id']) ? $categorie['id'] : "" ?>" type="hidden" name="id" id="id">

                <button type="submit"
                    name="<?= isset($_GET['id']) ? 'modifier' : 'ajouter' ?>"><?= !empty($_GET['id']) ? "Modifier" : "Ajouter" ?></button>

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
                    <th>Libellé</th>
                    <th>Action</th>
                </tr>
                <?php

                if (!empty($categories) && is_array($categories)) {
                    foreach ($categories as $key => $value) {
                        ?>
                        <tr>
                            <td><?= $value['libelle_categorie'] ?></td>
                            <td>
                                <a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt'></i></a>
                                <a href="?id=<?= $value['id'] ?>&delete=true"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie?')"><i
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