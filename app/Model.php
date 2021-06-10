<?php


// abstract => ne pourra pas être instancier directement, mais sera utiliser par héritage
abstract class Model
{
// informations de bdd
    private string $host = 'localhost:3306';
    private string $user = 'root';
    private string $password = 'root';
    private string $dbname = 'record';
// propriété contenant la connexion
    protected $_con;

//propriété contenant les information de requêtes
    public string $table;
    public string $disc_id;

    /**
     * connexion à la base de données
     */
    public function getConnection()
    {
        $this->_con = null;
        try {
            $this->_con = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->user, $this->password);
            $this->_con->exec('set names utf8');
        } catch (PDOException $exception) {
            echo 'Erreur :' . $exception->getMessage(); // Affichage du message d'erreur
        }
    }

    /**
     * méthode qui permet de récupérer toutes les données d'une table
     * @return mixed
     */
    public function getAll() {
        $query = 'SELECT * FROM ' . $this->table;
        $result = $this->_con->prepare($query);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * méthode qui permet de récupérer les détails d'une ligne d'une table
     * @param $disc_id
     * @return mixed
     */
    public function getOne(string $disc_id) {
        $this->disc_id = $disc_id;
        $query = 'SELECT * FROM ' . $this->table . ' WHERE `disc_id`=:disc_id' ;
        $result = $this->_con->prepare($query);
        $result->bindValue(':disc_id', $this->disc_id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch(PDO::FETCH_OBJ);
    }
}