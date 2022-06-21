<!-- ----- debut ModelEvenement -->

<?php
require_once 'Model.php';

class ModelEvenement {
    private $famille_id,$id,$iid,$event_type,$event_date,$event_lieu;


    public function __construct($famille_id = NULL,$id = NULL, $iid = NULL, $event_type = NULL, $event_date = NULL, $event_lieu = NULL) {
        // valeurs nulles si pas de passage de 
        if(!is_null($id)) {
            $this->id=$id;
            $this->famille_id=$famille_id;
            $this->iid=$iid;
            $this->event_date=$event_date;
            $this->event_lieu=$event_lieu;
            $this->event_type=$event_type;
        }
    }

    
  function setId($id)
  {
    $this->id = $id;
  }

  function setFamilleId($famille_id) {
    $this->famille_id=$famille_id;
  }
 
  function setIid($iid)
  {
    $this->iid = $iid;
  }

  function setEvent_type($event_type) {
    $this->event_type=$event_type;
  }

  function setEvent_lieu($event_lieu) {
    $this->event_lieu=$event_lieu;
  }
  function setEvent_date($event_date) {
    $this->event_date=$event_date;
  }


  function getId()
  {
    return $this->id;
  }

  function getFamilleId() {
    return $this->famille_id;
  }
 
  function getIid()
  {
    return $this->iid;
  }

  function getEvent_type() {
    return $this->event_type;
  }

  function getEvent_lieu() {
    return $this->event_lieu;
  }
  function getEvent_date() {
    return $this->event_date;
  }



  public static function getEvent($iid,$event_type) {
    try {
      $database = Model::getInstance();
      $query = "select * from evenement where iid = :iid and event_type = :event_type";
      $statement = $database->prepare($query);
      $statement->execute([
          'iid' => $iid,
          'event_type' => $event_type
      ]);
      $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelEvenement");
      return $results;
  } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
  }
  }
  public static function getAllEvent_types() {
    return array("NAISSANCE","DECES");
  }

  public static function getAllWithFamilyId($famille_id)
  {
      try {
          $database = Model::getInstance();
          $query = "select * from evenement where famille_id = :famille_id";
          $statement = $database->prepare($query);
          $statement->execute([
              'famille_id' => $famille_id
          ]);
          $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelEvenement");
          return $results;
      } catch (PDOException $e) {
          printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
          return NULL;
      }
  }


  public static function getAll()
  {
    try {
      $database = Model::getInstance();
      $query = "select * from evenement";
      $statement = $database->prepare($query);
      $statement->execute();
      $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelEvenement");
      return $results;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
  }

  public static function insert($famille_id,$iid,$event_type,$event_date,$event_lieu)
  {
    try {
      $database = Model::getInstance();

      // recherche de la valeur de la clé = max(id) + 1
      $query = "select max(id) from evenement";
      $statement = $database->query($query);
      $tuple = $statement->fetch();
      $id = $tuple['0'];
      $id++;

      // ajout d'un nouveau tuple;
      $query = "insert into evenement value (:famille_id,:id,:iid,:event_type,:event_date,:event_lieu)";
      $statement = $database->prepare($query);
      $statement->execute([
        'famille_id' => $famille_id,
        'id' => $id,
        'iid' => $iid,
        'event_type' => $event_type,
        'event_date' => $event_date,
        'event_lieu' => $event_lieu,
      ]);
      return $id;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return -1;
    }
  }
}

?>

<!-- ---- fin ModelEvenement -->