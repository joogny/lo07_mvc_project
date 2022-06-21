
<!-- ----- début viewInserted -->
<?php
require ($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';
    ?>
    <!-- ===================================================== -->
    <?php
    if ($results) {
     echo ("<h3>Confirmation de la création d'un évènement </h3>");
     echo("<ul>");
     echo ("<li>famille_id = " . (isset($famille_id) ? $famille_id : "") . "</li>");
     echo ("<li>individu_id = " . (isset($_GET['individu']) ? $_GET['individu'] : "") . "</li>");
     echo ("<li>event_id = " . (isset($results) ? $results : "") . "</li>");
     echo ("<li>event_type = " . (isset($_GET['event_type']) ? $_GET['event_type'] : "")  . "</li>");
     echo ("<li>event_date = " . (isset($_GET['event_date']) ? $_GET['event_date'] : ""). "</li>");
     echo ("<li>event_lieu = " . (isset($_GET['event_lieu']) ? $_GET['event_lieu'] : ""). "</li>");


     echo("</ul>");
    } else {
     echo ("<h3>Problème d'insertion de l'évènement</h3>");
     echo ("id = " . $_GET['id']);
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentGenealogieFooter.html';
    ?>
    <!-- ----- fin viewInserted -->    

    
    