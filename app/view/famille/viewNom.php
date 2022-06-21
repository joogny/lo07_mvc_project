
<!-- ----- début viewFamille -->
<?php 
require ($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
      include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';

      // $results contient un tableau avec la liste des noms et des ids
      ?>
  <h3><strong>Sélection d'une famille</strong></h3>

    <form role="form" method='get' action='router.php'>
      <div class="form-group">
      <input type="hidden" name='action' value='familleSelected'>        

        <label for="id">Nom : </label> <select class="form-control" id='id' name='id' style="width: 100px">
            <?php
            foreach ($results as $element) {
             printf("<option value=%d>%s</option>", $element->getId(), 
             $element->getNom());
            }
            ?>
        </select>
      </div>
      <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
    <p/>
  </div>

  <?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

  <!-- ----- fin viewId -->