<!-- ----- debut fragmentGenealogieJumbotron -->

<div class="jumbotron">
  <h1>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    if (isset($_SESSION['famille'])) {
      echo ('FAMILLE ' . $_SESSION['famille']);
    } else {
      echo ('PAS DE FAMILLE SELECTIONNEE');
    }

    ?>
  </h1>
</div>
<!-- ----- fin fragmentGenealogieJumbotron -->