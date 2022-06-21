
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
      // $event_types contient une liste des types d'évènements
      ?>
  <h3><strong>Ajout d'un évènement</strong></h3>

    <form role="form" method='get' action='router.php'>
      <div class="form-group">
      <input type="hidden" name='action' value='evenementCreated'>        

        <label for="id">Sélectionnez un individu: </label> <select class="form-control event_form" id='individu' name='individu' style="width: 100px">
            <?php
            foreach ($individu_list as $individu) {
             printf("<option value=%d>%s : %s</option>", $individu->getId(), 
             $individu->getNom(),$individu->getPrenom());
            }
            ?>
        </select>
        <label for="id">Sélectionnez un type d'evenement: </label> <select class="form-control event_form" id='event_type' name='event_type' style="width: 100px">
            <?php
            foreach ($event_types as $event_type) {
             printf("<option value=%s>%s</option>",  $event_type, 
             $event_type);
            }
            ?>
        </select>
        <label for="event_date">DATE (AAAA-MM-JJJJ) ?</label>
        <input id="event_date" name="event_date"  class="form-control event_form" type="date"  >
        <label for="id">Lieu ? </label><input class="form-control event_form" id="event_lieu" name="event_lieu" type="text">
      </div>
      <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
  </div>

  <?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

  <!-- ----- fin viewId -->