<!-- ----- début viewInsert -->

<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
        include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';
        ?>
  <h3><strong>Ajout d'un individu</strong></h3>

        <form role="form" method='get' action='router.php'>
            <div class="form-group">
                <input type="hidden" name='action'  value='individuCreated'>
                <label for="id">Nom ? </label><input class="form-control" type="text" name='nom' size='75' value=''>
                <br><label for="id">Prenom ? </label><input class="form-control" type="text" name='prenom' size='75' value=''>
                <br><label><strong>Sexe ? </strong></label>

                <div class="form-check form-check-inline">
                    <label class="radio-inline">
                        <input type="radio" name="sexe" id="sexe" value="M" checked>Masculin
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="sexe" id="sexe" value="F">Féminin
                    </label>
                </div>

            </div>
            <p>
                <button class="btn btn-primary" type="submit">Go</button>
            </p>
        </form>
    </div>
    <?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

    <!-- ----- fin viewInsert -->