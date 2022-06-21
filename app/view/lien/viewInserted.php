
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
     echo ("<h3>Confirmation de la création d'un lien Union</h3>");
     echo("<ul>");
     echo ("<li>id = " . $results . "</li>");
     echo ("<li>famille id = " . $famille_id . "</li>");
     echo ("<li>homme_id = " . $_GET['iid1'] . "</li>");
     echo ("<li>femme_id = " . $_GET['iid2'] . "</li>");
     echo ("<li>lien_type = " . $_GET['lien_type'] . "</li>");
     echo ("<li>lien_date = " . $_GET['lien_date'] . "</li>");
     echo ("<li>lien_lieu= " . $_GET['lien_lieu'] . "</li>");


     echo("</ul>");
    } else {
     echo ("<h3>Problème d'insertion de la famille</h3>");
     echo ("id = " . $_GET['id']);
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentGenealogieFooter.html';
    ?>
    <!-- ----- fin viewInserted -->    

    
    