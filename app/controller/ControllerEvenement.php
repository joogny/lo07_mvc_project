<?php
require_once '../model/ModelEvenement.php';
require_once '../model/ModelIndividu.php';

class ControllerEvenement
{

    // --- Liste des evenements
    public static function EvenementReadAll()
    {
        session_start();
        $famille = $_SESSION["famille_id"];
        $results = ModelEvenement::getAllWithFamilyId($famille);
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/evenement/viewAll.php';
        if (DEBUG)
            echo ("ControllerEvenement : EvenementsReadAll : vue = $vue");
        require($vue);
    }

    //Affiche un formulaire de création d'évènements

    public static function EvenementCreate()
    {
        session_start();
        $individu_list = ModelIndividu::getAllWithFamilyId($_SESSION["famille_id"]);
        $event_types = ModelEvenement::getAllEvent_types();

        include 'config.php';
        $vue = $root . '/app/view/evenement/viewInsert.php';
        if (DEBUG)
            echo ("ControllerEvenement : EvenementsCreate : vue = $vue");
        require($vue);
    }


    // Affiche un formulaire pour récupérer les informations d'un nouvel evenement
    // La clé est gérée par le systeme et pas par l'internaute
    public static function EvenementCreated()
    {
        session_start();
        $famille_id = isset($_SESSION["famille_id"]) ? $_SESSION["famille_id"] : "";
        // ajouter une validation des informations du formulaire
        $results = ModelEvenement::insert(
            $famille_id,
            (isset($_GET['individu']) ? htmlspecialchars($_GET['individu']) : ""),
            (isset($_GET['event_type']) ? htmlspecialchars($_GET['event_type']) : ""),
            (isset($_GET['event_date']) ? htmlspecialchars($_GET['event_date']) : ""),
            (isset($_GET['event_lieu']) ? htmlspecialchars($_GET['event_lieu']) : "")
        );
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/evenement/viewInserted.php';
        require($vue);
    }
}
