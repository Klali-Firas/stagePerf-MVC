<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'entete.php';
include '../model1/Commande/CRUDCommande.php';
include '../model1/Vente/CRUDVente.php';
include '../model1/Article/CRUDArticle.php';
 $CRUD_Commande = new CRUDCommande();
 $CRUD_Vente = new CRUDVente();
 $CRUD_Article = new CRUDArticle();
?>

<div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Commande</div>
              <div class="number">
                <?php
                  echo $CRUD_Commande->getAllCommande()['nbre']
                ?>
              </div>
              <div class="indicator">
                
              </div>
            </div>
            <i class="bx bx-cart-alt cart"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Vente</div>
              <div class="number">
              <?php
                  echo $CRUD_Vente->getCountVente()['nbre']
                ?>
              </div>
              <div class="indicator">
                
              </div>
            </div>
            <i class="bx bxs-cart-add cart two"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Article</div>
              <div class="number">
                <?php
                    echo $CRUD_Article->getCountArticle()['nbre']
                  ?>
              </div>
              <div class="indicator">
                
              </div>
            </div>
            <i class="bx bx-cart cart three"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Chiffre d'affaire</div>
              <div class="number">
                  <?php
                    echo number_format($CRUD_Vente->getCA()['prix']) . ' DT'
                  ?>
              </div>
              <div class="indicator">
                
              </div>
            </div>
            <i class="bx bxs-cart-download cart four"></i>
          </div>
        </div>

        <div class="sales-boxes">
          <div class="recent-sales box">
            <div class="title">Ventes récentes</div>

                  <?php
                    $ventes = $CRUD_Vente->getAllVentes();
                  ?>

            <div class="sales-details">

              <ul class="details">
                <li class="topic">Date</li>

                  <?php
                    foreach ($ventes as $key => $value) {
                  ?>
                      <li><a href="#"><?php echo date('d M y ', strtotime($value['date_vente'])) ?></a></li>

                    <?php
                    }
                    ?>

              </ul>

              <ul class="details">
                <li class="topic">Client</li>

                  <?php
                    foreach ($ventes as $key => $value) {
                  ?>
                      <li><a href="#"><?php echo $value['nom']." ".$value['prenom'] ?></a></li>

                    <?php
                    }
                    ?>

              </ul>
              <ul class="details">
                <li class="topic">Article</li>

                  <?php
                    foreach ($ventes as $key => $value) {
                  ?>
                      <li><a href="#"><?php echo $value['nom_article'] ?></a></li>

                    <?php
                    }
                    ?>

              </ul>
              <ul class="details">
                <li class="topic">Prix</li>

                  <?php
                    foreach ($ventes as $key => $value) {
                  ?>
                      <li><a href="#"><?php echo number_format($value['prix'])." DT" ?></a></li>

                    <?php
                    }
                    ?>

              </ul>
            </div>
          </div>
          <div class="top-sales box">
            <div class="title">Articles les plus vendus</div>
            <ul class="top-sales-details">

                  <?php
                    $article = $CRUD_Vente->getMostVente();
                    foreach ($article as $key => $value) {
                  ?>
                  <li>
                    <a href="#">
                      <span class="product"><?php echo $value['nom_article'] ?></span>
                    </a>
                      <span class="price"><?php echo number_format($value['prix'])." DT" ?></span>
                  </li>
                      <?php
                        }
                      ?>

            </ul>
          </div>
        </div>
      </div>
    </section>

<?php
include 'pied.php';
?>