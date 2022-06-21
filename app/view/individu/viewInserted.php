
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
     echo ("<h3>Confirmation de la création d'un individu </h3>");
     echo("<ul>");
     echo ("<li>famille_id = " . (isset($famille_id) ? $famille_id : ""). "</li>");
     echo ("<li>id = " . $results . "</li>");
     echo ("<li>nom = " . (isset($_GET['nom']) ? $_GET['nom'] : "")  . "</li>");
     echo ("<li>prenom = " . (isset($_GET['prenom']) ? $_GET['prenom'] : ""). "</li>");
     echo ("<li>sexe = " . (isset($_GET['sexe']) ? $_GET['sexe'] : "" ). "</li>");
     echo ("<li>pere = " . (isset($pere) ? $pere : "") . "</li>");
     echo ("<li>mere = " . (isset($mere) ? $mere : "") . "</li>");

     echo("</ul>");
    } else {
     echo ("<h3>Problème d'insertion de l'individu</h3>");
     echo ("nom = " . $_GET['nom']);
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentGenealogieFooter.html';
    ?>
    <!-- ----- fin viewInserted -->    

    
    