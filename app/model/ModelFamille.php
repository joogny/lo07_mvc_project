<!-- ----- debut ModelFamille -->

<?php
require_once 'Model.php';

class ModelFamille
{
  private $id, $nom;

  // pas possible d'avoir 2 constructeurs
  public function __construct($id = NULL, $nom = NULL)
  {
    // valeurs nulles si pas de passage de parametres
    if (!is_null($id)) {
      $this->id = $id;
      $this->nom = $nom;
    }
  }

  function setId($id)
  {
    $this->id = $id;
  }

  function setNom($nom)
  {
    $this->nom = $nom;
  }
  function getId()
  {
    return $this->id;
  }

  function getNom()
  {
    return $this->nom;
  }


  // retourne une liste des id
  public static function getAllId()
  {
    try {
      $database = Model::getInstance();
      $query = "select id from famille";
      $statement = $database->prepare($query);
      $statement->execute();
      $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
      return $results;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
  }

  //supprime une famille avec son id
  public static function delete($id)
  {
    try {
      $database = Model::getInstance();
      $query = "DELETE FROM famille WHERE id=:id";
      $statement = $database->prepare($query);
      $statement->execute([
        'id' => $id
      ]);
      return $id;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return -1;
    }
  }


  public static function getMany($query)
  {
    try {
      $database = Model::getInstance();
      $statement = $database->prepare($query);
      $statement->execute();
      $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelFamille");
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
      $query = "select * from famille";
      $statement = $database->prepare($query);
      $statement->execute();
      $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelFamille");
      return $results;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
  }

  //retourne une famille avec son ID
  public static function getOne($id)
  {
    try {
      $database = Model::getInstance();
      $query = "select * from famille where id = :id";
      $statement = $database->prepare($query);
      $statement->execute([
        'id' => $id
      ]);
      $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelFamille");
      return $results;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
  }

  public static function insert($nom)
  {
    try {
      $database = Model::getInstance();

      // recherche de la valeur de la clé = max(id) + 1
      $query = "select max(id) from famille";
      $statement = $database->query($query);
      $tuple = $statement->fetch();
      $id = $tuple['0'];
      $id++;

      // ajout d'un nouveau tuple;
      $query = "insert into famille value (:id, :nom)";
      $statement = $database->prepare($query);
      $statement->execute([
        'id' => $id,
        'nom' => $nom
      ]);
      $_SESSION['famille'] = $nom;
      return $id;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return -1;
    }
  }

}
?>
<!-- ----- fin ModelFamille -->