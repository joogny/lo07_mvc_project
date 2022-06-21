
<!-- ----- début viewFamille -->
<?php 
require ($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
      include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';

      // $individu_list contient une liste des individus
      ?>
  <h3><strong>Ajout d'un lien parental</strong></h3>

    <form role="form" method='get' action='router.php'>
      <div class="form-group">
      <input type="hidden" name='action' value='individuParentInserted'>        

        <label for="id">Sélectionnez un enfant: </label> <select class="form-control event_form" id='enfant' name='enfant' style="width: 100px">
            <?php
            foreach ($individu_list as $individu) {
             printf("<option value=%d>%s : %s</option>", $individu->getId(), 
             $individu->getNom(),$individu->getPrenom());
            }
            ?>
        </select>
        <label for="id">Sélectionnez un parent: </label> <select class="form-control event_form" id='parent' name='parent' style="width: 100px">
            <?php
            foreach ($individu_list as $individu) {
             printf("<option value=%d>%s : %s</option>", $individu->getId(), 
             $individu->getNom(),$individu->getPrenom());
            }
            ?>
        </select>
      </div>
      <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
  </div>

  <?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

  <!-- ----- fin viewId -->