<!-- ----- debut ControllerFamille -->
<?php
require_once '../model/ModelFamille.php';

class ControllerFamille
{
    // --- page d'acceuil
    public static function genealogieAccueil()
    {
        include 'config.php';
        $vue = $root . '/app/view/viewGenealogieAccueil.php';
        if (DEBUG)
            echo ("ControllerFamille : genealogieAccueil : vue = $vue");
        require($vue);
    }

    // --- Liste des familles
    public static function FamilleReadAll()
    {
        $results = ModelFamille::getAll();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/viewAll.php';
        if (DEBUG)
            echo ("ControllerFamille : familleReadAll : vue = $vue");
        require($vue);
    }

    // Affiche un formulaire pour sélectionner un nom qui existe
    public static function familleReadNom($args)
    {
        $results = ModelFamille::getAll();

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/viewNom.php';
        require($vue);
    }

    // Selectionne une famille 
    public static function familleSelected()
    {
        session_start();
        $famille_id = $_GET['id'];
        if (isset($famille_id)) {
            $results = ModelFamille::getOne($famille_id)[0];
            $_SESSION["famille"] = $results->getNom();
            $_SESSION["famille_id"] = $results->getId();
        }
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/viewSelected.php';
        require($vue);
    }

    // Affiche le formulaire de creation d'une famille
    public static function familleCreate()
    {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/viewInsert.php';
        require($vue);
    }



    // Affiche un formulaire pour récupérer les informations d'une nouvelle famille
    // La clé est gérée par le systeme et pas par l'internaute
    public static function familleCreated()
    {
        // ajouter une validation des informations du formulaire
        $results = ModelFamille::insert(
            (isset($_GET['nom']) ? htmlspecialchars($_GET['nom']) : "")
        );
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/viewInserted.php';
        require($vue);
        if ($results) {
            $_SESSION["famille"] = $_GET['nom'];
            $_SESSION["famille_id"] = $results;
        }
    }
}
?>
<!-- ----- fin ControllerFamille -->