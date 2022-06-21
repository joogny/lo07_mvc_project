
<!-- ----- début viewAll -->
<?php

require ($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
      include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';
      ?>
  <h3><strong>Liste des individus</strong></h3>

    <table class = "table table-striped table-bordered">
      <thead>
        <tr>
          <th scope = "col">famille_id</th>
          <th scope = "col">id</th>
          <th scope = "col">nom</th>
          <th scope = "col">prenom</th>
          <th scope = "col">sexe</th>
          <th scope = "col">pere</th>
          <th scope = "col">mere</th>

        </tr>
      </thead>
      <tbody>
          <?php
          // La liste des familles est dans une variable $results             
          foreach ($results as $element) {
            printf("<tr><td>%d</td><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%d</td><td>%d</td></tr>", $element->getFamille_Id(), 
            $element->getId(),$element->getNom(),$element->getPrenom(),$element->getSexe(),$element->getPere(),$element->getMere());
          }
          ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

  <!-- ----- fin viewAll -->
  
  
  