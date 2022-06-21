<?php
require_once '../model/ModelLien.php';
require_once '../model/ModelIndividu.php';

class ControllerLien
{
    //Affiche dans un tableau tous les liens sur la famille sélectionné
    public static function LienReadAllFromFamily()
    {
        session_start();
        $famille = $_SESSION["famille_id"];
        $results = ModelLien::getAllWithFamilyId($famille);
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/lien/viewAll.php';
        if (DEBUG)
            echo ("ControllerLien : LienReadAllFromFamily : vue = $vue");
        require($vue);
    }


        // Affiche le formulaire de creation d'un lien 
        public static function lienCreate()
        {
            $individu_list = ModelIndividu::getAllWithFamilyId($_SESSION["famille_id"]);
            $lien_types = ModelLien::getAllLien_types();
            // ----- Construction chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/lien/viewInsert.php';
            require($vue);
        }
    
        public static function LienCreated()
        {

            //on va utiliser la famille de l'homme pour décider famille_id;
            $famille_id = isset($_SESSION["famille_id"]) ? $_SESSION["famille_id"] : "";

            // ajouter une validation des informations du formulaire
            $results = ModelLien::insert(
                (isset($_GET['iid1']) ? htmlspecialchars($_GET['iid1']) : ""),
                (isset($_GET['iid2']) ? htmlspecialchars($_GET['iid2']) : ""),
                $famille_id,
                (isset($_GET['lien_type']) ? htmlspecialchars($_GET['lien_type']) : ""),
                (isset($_GET['lien_date']) ? htmlspecialchars($_GET['lien_date']) : ""),
                (isset($_GET['lien_lieu']) ? htmlspecialchars($_GET['lien_lieu']) : "")
            );
            // ----- Construction chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/lien/viewInserted.php';
            require($vue);
        }

}
?>