<div class="home-content">
  <div class="overview-boxes">
    <div class="box">
      <div class="right-side">
        <div class="box-topic">Commande</div>
        <div class="number">
          <?= $nbreCommande ?>
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
          <?= $nbreVente ?>
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
          <?= $nbreArticle ?>
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
          echo number_format($chiffreAffaire) . ' DT'
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


      <div class="sales-details">

        <ul class="details">
          <li class="topic">Date</li>

          <?php
          foreach ($allVentes as $key => $value) {
            ?>
            <li><a href="#"><?php echo date('d M y ', strtotime($value['date_vente'])) ?></a></li>

            <?php
          }
          ?>

        </ul>

        <ul class="details">
          <li class="topic">Client</li>

          <?php
          foreach ($allVentes as $key => $value) {
            ?>
            <li><a href="#"><?php echo $value['nom'] . " " . $value['prenom'] ?></a></li>

            <?php
          }
          ?>

        </ul>
        <ul class="details">
          <li class="topic">Article</li>

          <?php
          foreach ($allVentes as $key => $value) {
            ?>
            <li><a href="#"><?php echo $value['nom_article'] ?></a></li>

            <?php
          }
          ?>

        </ul>
        <ul class="details">
          <li class="topic">Prix</li>

          <?php
          foreach ($allVentes as $key => $value) {
            ?>
            <li><a href="#"><?php echo number_format($value['prix']) . " DT" ?></a></li>

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
        foreach ($mostVenteArticle as $key => $value) {
          ?>
          <li>
            <a href="#">
              <span class="product"><?php echo $value['nom_article'] ?></span>
            </a>
            <span class="price"><?php echo number_format($value['prix']) . " DT" ?></span>
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
$contenu = ob_get_clean();
include_once '../vue/layout.php';
?>