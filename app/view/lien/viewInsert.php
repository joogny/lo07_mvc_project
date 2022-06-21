<!-- ----- début viewFamille -->
<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';

    // $individu_list contient la liste des individus
    // $lien_types contient la liste des types de lien
    ?>
    <h3><strong>Ajout d'une union</strong></h3>

    <form role="form" method='get' action='router.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='lienCreated'>

        <label for="id">Sélectionnez un homme: </label> <select class="form-control event_form" id='iid1' name='iid1' style="width: 100px">
          <?php
          foreach ($individu_list as $individu) {
            if ($individu->getSexe() == "H") {
              printf(
                "<option value=%d>%s : %s</option>",
                $individu->getId(),
                $individu->getNom(),
                $individu->getPrenom()
              );
            }
          }
          ?>
        </select>
        <label for="id">Sélectionnez une femme: </label> <select class="form-control event_form" id='iid2' name='iid2' style="width: 100px">
          <?php
          foreach ($individu_list as $individu) {
            if ($individu->getSexe() == "F") {
            printf(
              "<option value=%d>%s : %s</option>",
              $individu->getId(),
              $individu->getNom(),
              $individu->getPrenom()
            );
          }
          }
          ?>
        </select>
        <label for="id">Sélectionnez un type de lien: </label> <select class="form-control event_form" id='lien_type' name='lien_type' style="width: 100px">
          <?php
          foreach ($lien_types as $lien_type) {
            printf(
              "<option value=%s>%s</option>",
              $lien_type,
              $lien_type
            );
          }
          ?>
        </select>
        <label for="event_date">DATE (AAAA-MM-JJJJ) ?</label>
        <input id="lien_date" name="lien_date" class="form-control event_form" type="date">
        <label for="id">Lieu ? </label><input class="form-control event_form" id="lien_lieu" name="lien_lieu" type="text">
      </div>
      <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
  </div>

  <?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

  <!-- ----- fin viewId -->