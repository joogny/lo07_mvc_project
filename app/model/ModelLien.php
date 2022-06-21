<!-- ----- debut ModelLien-->

<?php
require_once 'Model.php';

class ModelLien
{
    private $famille_id, $id, $iid1, $iid2, $lien_type, $lien_date, $lien_lieu;


    public function __construct($famille_id = NULL, $id = NULL, $iid1 = NULL, $iid2 = NULL, $lien_type = NULL, $lien_date = NULL, $lien_lieu = NULL)
    {
        // valeurs nulles si pas de passage de 
        if (!is_null($id)) {
            $this->id = $id;
            $this->famille_id = $famille_id;
            $this->iid1 = $iid1;
            $this->iid2 = $iid2;
            $this->lien_date = $lien_date;
            $this->lien_lieu = $lien_lieu;
            $this->lien_type = $lien_type;
        }
    }


    function setId($id)
    {
        $this->id = $id;
    }

    function setFamilleId($famille_id)
    {
        $this->famille_id = $famille_id;
    }

    function setIid1($iid1)
    {
        $this->iid1 = $iid1;
    }

    function setIid2($iid2)
    {
        $this->iid2 = $iid2;
    }

    function setLien_type($lien_type)
    {
        $this->lien_type = $lien_type;
    }

    function setLien_lieu($lien_lieu)
    {
        $this->lien_lieu = $lien_lieu;
    }
    function setLien_date($lien_date)
    {
        $this->lien_date = $lien_date;
    }


    function getId()
    {
        return $this->id;
    }

    function getFamilleId()
    {
        return $this->famille_id;
    }

    function getIid1()
    {
        return $this->iid1;
    }
    function getIid2()
    {
        return $this->iid2;
    }

    function getLien_type()
    {
        return $this->lien_type;
    }

    function getLien_lieu()
    {
        return $this->lien_lieu;
    }
    function getLien_date()
    {
        return $this->lien_date;
    }


    public static function getAllWithFamilyId($famille_id)
    {
        try {
            $database = Model::getInstance();
            $query = "select * from lien where famille_id = :famille_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelLien");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }


    public static function getAllLien_types()
    {
        return array("COUPLE", "SEPARATION", "PACS", "MARIAGE", "DIVORCE");
    }

    public static function getAllWithIiD($id) {
        try {
            $database = Model::getInstance();
            $query = "select * from lien where iid1 = :id or iid2 = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelLien");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }


    public static function insert($homme_id, $femme_id,$famille_id, $lien_type, $lien_date, $lien_lieu)
    {
        try {
            $database = Model::getInstance();



            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from lien";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;



        

            // ajout d'un nouveau tuple;
            $query = "insert into lien value (:famille_id,:id,:iid1,:iid2,:lien_type,:lien_date,:lien_lieu)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'id' => $id,
                'iid1' => $homme_id,
                'iid2' => $femme_id,
                'lien_type' => $lien_type,
                'lien_date' => $lien_date,
                'lien_lieu' => $lien_lieu,
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
}

?>

<!-- ---- fin ModelLien -->