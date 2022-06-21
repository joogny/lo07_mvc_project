
<!-- ----- début viewFamille -->
<?php 
require ($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
      include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';

      // $individu_list contient un tableau avec la liste des individus
      ?>
  <h3><strong>Sélection d'un individu</strong></h3>

    <form role="form" method='get' action='router.php'>
      <div class="form-group">
      <input type="hidden" name='action' value='individuSelected'>        

        <label for="id">Nom : </label> <select class="form-control event_form" id='id' name='id' style="width: 100px">
            <?php
            foreach ($individu_list as $element) {
             printf("<option value=%d>%s : %s</option>", $element->getId(), 
             $element->getNom(), $element->getPrenom());
            }

            ?>
        </select>
      </div>
      <button class="btn btn-primary" type="submit">Go</button>
    </form>
    <p/>
  </div>

  <?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

  <!-- ----- fin viewId -->