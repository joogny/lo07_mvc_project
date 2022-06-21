
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
  <h3><strong>Liste des évènements</strong></h3>

    <table class = "table table-striped table-bordered">
      <thead>
        <tr>
          <th scope = "col">famille_id</th>
          <th scope = "col">id</th>
          <th scope = "col">iid</th>
          <th scope = "col">event_type</th>
          <th scope = "col">event_date</th>
          <th scope = "col">event_lieu</th>
        </tr>
      </thead>
      <tbody>
          <?php
          // La liste des evenements est dans une variable $results             
          foreach ($results as $element) {
           printf("<tr><td>%d</td><td>%d</td><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>", $element->getFamilleId(), 
             $element->getId(),$element->getIid(),$element->getEvent_type(),$element->getEvent_date(),$element->getEvent_lieu());
          }
          ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

  <!-- ----- fin viewAll -->
  
  
  