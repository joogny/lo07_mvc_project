<?php
require_once '../model/ModelIndividu.php';

class ControllerIndividu
{


    public static function IndividuReadAllFromFamily()
    {
        session_start();
        $famille = $_SESSION["famille_id"];
        $results = ModelIndividu::getAllWithFamilyId($famille);
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/individu/viewAll.php';
        if (DEBUG)
            echo ("ControllerIndividu : IndividuReadAllFromFamily : vue = $vue");
        require($vue);
    }

    //affiche le formulaire d'ajout d'un individu
    public static function individuCreate()
    {

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/individu/viewInsert.php';
        require($vue);
    }

    public static function IndividuCreated()
    {
        session_start();
        //on va utiliser la famille sélectionné
        $famille_id = isset($_SESSION["famille_id"]) ? $_SESSION["famille_id"] : "  ";
        $pere = 0;
        $mere = 0;
        // ajouter une validation des informations du formulaire
        $results = ModelIndividu::insert(
            $famille_id,
            (isset($_GET['nom']) ? htmlspecialchars($_GET['nom']) : ""),
            (isset($_GET['prenom']) ? htmlspecialchars($_GET['prenom']) : ""),
            (isset($_GET['sexe']) ? htmlspecialchars($_GET['sexe']) : ""),
            $pere,
            $mere
        );
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/individu/viewInserted.php';
        require($vue);
    }
    // Affiche le formulaire d'ajout d'un parent
    public static function IndividuParentInsert()
    {
        session_start();
        $individu_list = ModelIndividu::getAllWithFamilyId($_SESSION["famille_id"]);
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/individu/viewParentInsert.php';
        require($vue);
    }

    public static function IndividuSelect()
    {
        session_start();
        $individu_list = ModelIndividu::getAllWithFamilyId($_SESSION["famille_id"]);
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/individu/viewSelect.php';
        require($vue);
    }
    public static function IndividuSelected()
    {
        session_start();
        if (isset($_GET["id"])) {
            $individu = ModelIndividu::getOne($_GET["id"]);
            $naissance = ModelEvenement::getEvent($_GET["id"], "NAISSANCE");
            $deces = ModelEvenement::getEvent($_GET["id"], "DECES");

            $pere = array();
            $mere = array();
            if (!empty($individu)) {
                $pere = ModelIndividu::getOne($individu[0]->getPere());
                $mere = ModelIndividu::getOne($individu[0]->getMere());
            }


            $unions_individus = ModelIndividu::getUnions($_GET["id"]);
        }
        include 'config.php';
        $vue = $root . '/app/view/individu/viewSelected.php';
        require($vue);
    }

    public static function IndividuParentInserted()
    {
        $enfant_id = $_GET['enfant'];
        $parent_id = $_GET['parent'];
        $results = ModelIndividu::addParent($enfant_id, $parent_id);
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/individu/viewParentInserted.php';
        require($vue);
    }
}
