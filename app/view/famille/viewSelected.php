<!-- ----- début viewInserted -->
<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';
    ?>
    <!-- ===================================================== -->
    <?php
    if (!isset($_GET["id"])) {
      echo ("<h3>Pas de famille sélectionné</h3>");
    } else {
      if ($results) {
        echo ("<h3>Confirmation de la sélection d'une famille </h3>");
        echo ("La famille " . $results->getNom() . " (" .  $results->getId() . ") est maintenant sélectionnée");
      } else {
        echo ("<h3>Impossible de sélectionner la famille</h3>");
        echo ("id = " . $_GET['id']);
      }

      echo ("</div>");
    }
    include $root . '/app/view/fragment/fragmentGenealogieFooter.html';
    ?>
    <!-- ----- fin viewSelectedd -->