<!-- ----- debut ModelIndividu -->


<?php
require_once 'Model.php';

class ModelIndividu
{
    private $famille_id, $id, $nom, $prenom, $sexe, $pere, $mere;

    public function __construct($famille_id = NULL, $id = NULL, $nom = NULL, $prenom = NULL, $sexe = NULL, $pere = NULL, $mere = NULL)
    {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->id = $id;
            $this->famille_id = $famille_id;
            $this->prenom = $prenom;
            $this->sexe = $sexe;
            $this->mere = $mere;
            $this->pere = $pere;
            $this->nom = $nom;
        }
    }
    function getId()
    {
        return $this->id;
    }
    function getFamille_id()
    {
        return $this->famille_id;
    }
    function getNom()
    {
        return $this->nom;
    }
    function getPrenom()
    {
        return $this->prenom;
    }
    function getSexe()
    {
        return $this->sexe;
    }
    function getPere()
    {
        return $this->pere;
    }
    function getMere()
    {
        return $this->mere;
    }


    function setId($id)
    {
        $this->id = $id;
    }
    function setFamille_id($famille_id)
    {
        $this->famille_id = $famille_id;
    }
    function setNom($nom)
    {
        $this->nom = $nom;
    }
    function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }
    function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }
    function setPere($pere)
    {
        $this->pere = $pere;
    }
    function setMere($mere)
    {
        $this->mere = $mere;
    }


    public static function getAll()
    {
        try {
            $database = Model::getInstance();
            $query = "select * from individu";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndividu");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getAllWithFamilyId($famille_id)
    {
        try {
            $database = Model::getInstance();
            $query = "select * from individu where famille_id = :famille_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndividu");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getMany($query)
    {
        try {
            $database = Model::getInstance();
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndividu");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    //retourne un individu avec son ID
    public static function getOne($id)
    {
        try {
            $database = Model::getInstance();
            $query = "select * from individu where id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndividu");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    //ajoute un lien parental entre l'enfant et le parent
    public static function addParent($enfant_id, $parent_id)
    {
        try {
            $database = Model::getInstance();

            // recherche du parent
            $parent = ModelIndividu::getOne($parent_id)[0];

            if ($parent->getSexe() == "H") {
                $query = "update individu SET pere = :parent_id WHERE id = :enfant_id";
            } else {
                //par défaut si le sexe n'est pas précisé on part du principe que le parent est la mère
                $query = "update individu SET mere = :parent_id WHERE id = :enfant_id";
            }



            $statement = $database->prepare($query);
            $statement->execute([
                'parent_id' => $parent_id,
                'enfant_id' => $enfant_id
            ]);
            return $parent_id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function insert($famille_id, $nom, $prenom, $sexe, $pere, $mere)
    {
        try {
            $database = Model::getInstance();



            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from individu";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;





            // ajout d'un nouveau tuple;
            $query = "insert into individu value (:famille_id,:id,:nom,:prenom,:sexe,:pere,:mere)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'sexe' => $sexe,
                'pere' => $pere,
                'mere' => $mere,
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }


    public static function getAllWithMotherAndFather($mother_id, $father_id)
    {
        try {
            $database = Model::getInstance();
            $query = "select * from individu where pere = :pere_id AND mere = :mere_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'pere_id' => $father_id,
                'mere_id' => $mother_id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndividu");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    public static function getUnions($id)
    {
        try {
            $database = Model::getInstance();


            $unions = ModelLien::getAllWithIiD($id);


            $union_array = array();
            $unions_individus = array();


            foreach ($unions as $union) {
                $unionListe = array();

                $iid1 = ModelIndividu::getOne($union->getIid1())[0];
                $iid2 =  ModelIndividu::getOne($union->getIid2())[0];
                if ($union->getIid1() != $id) {
                    $iid = $iid1;
                }
                if ($union->getIid2() != $id) {
                    $iid = $iid2;
                }

                if (!in_array($iid, $union_array)) {
                    if ($iid->getSexe() == "H") {
                        $enfants = ModelIndividu::getAllWithMotherAndFather($id, $iid->getId());
                    } else {
                        $enfants = ModelIndividu::getAllWithMotherAndFather($iid->getId(), $id);
                    }

                    $unionListe["lien"] = $iid;
                    $unionListe["enfants"] = $enfants;
                    array_push($union_array, $iid);
                    array_push($unions_individus, $unionListe);
                }
            }
            return $unions_individus;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
}

?>


<!-- ----- fin ModelIndividu -->