
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
     echo ("<h3>Confirmation de la création d'un lien parental </h3>");
     echo("<ul>");
     echo ("<li>parent = " . (isset($_GET["parent"]) ? $_GET["parent"] : "") . "</li>");
     echo ("<li>enfant = " . (isset($_GET['enfant']) ? $_GET['enfant'] : "") . "</li>");

     echo("</ul>");
    } else {
     echo ("<h3>Problème de création de lien parental</h3>");
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentGenealogieFooter.html';
    ?>
    <!-- ----- fin viewInserted -->    

    
    