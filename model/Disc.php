<?php


class Disc extends DiscsEntity
{
    /**
     * stockage de la table 'disc' dans un objet et connexion à la bdd 'record'
     */
    public function __construct()
    {
        $this->table = 'disc';
        $this->getConnection();
    }

    /**
     * récupération de toutes les données des discs
     * @return array
     */
    public function getDiscsInformations(): array
    {
        $query = 'SELECT * FROM ' . $this->table . ' INNER JOIN `artist` ON ' . $this->table . '.`artist_id` = `artist`.`artist_id` GROUP BY `disc_title` ASC';
        $result = $this->_con->prepare($query);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_OBJ);

    }

    /**
     * récupération des données d'un disc selon son id
     * @param $disc_id
     * @return mixed
     */
    public function getOneDiscById($disc_id)
    {
        $query = 'SELECT *  FROM ' . $this->table . ' INNER JOIN `artist` ON ' . $this->table . '.`artist_id` = `artist`.`artist_id` WHERE ' . $this->table . '.`disc_id` = :disc_id';
        $result = $this->_con->prepare($query);
        $result->bindValue(':disc_id', $disc_id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch(PDO::FETCH_OBJ);
    }

    /**
     * modification des données dans la table 'disc' sauf celles de l'image 'disc_picture'
     * @param $disc_id
     * @return bool
     */
    public function updateDisc($disc_id): bool
    {
        $query = 'UPDATE ' . $this->table . ' SET `disc_title` = :title, `disc_year` = :year, `disc_label` = :label, `disc_genre` = :genre, `disc_price` = :price, `artist_id` = :artist WHERE ' . $this->table . '.`disc_id` = :disc_id';
        $result = $this->_con->prepare($query);
        $result->bindValue(':title', $this->disc_title, PDO::PARAM_STR);
        $result->bindValue(':year', $this->disc_year, PDO::PARAM_STR);
        $result->bindvalue(':label', $this->disc_label, PDO::PARAM_STR);
        $result->bindvalue(':genre', $this->disc_genre, PDO::PARAM_STR);
        $result->bindvalue(':price', $this->disc_price, PDO::PARAM_STR);
        $result->bindvalue(':artist', $this->artist_id, PDO::PARAM_INT);
        $result->bindValue(':disc_id', $disc_id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * modification d'une image dans la base selon son id
     * @param $disc_id
     * @return bool
     */
    public function updatePicture($disc_id): bool
    {
        $query = 'UPDATE ' . $this->table . ' SET `disc_picture` = :picture WHERE ' . $this->table . '.`disc_id` = :disc_id';
        $result = $this->_con->prepare($query);
        $result->bindvalue(':picture', $this->disc_picture, PDO::PARAM_STR);
        $result->bindValue(':disc_id', $disc_id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * ajout de données dans la table disc
     * @return bool
     */
    public function addDisc(): bool
    {
        $query = 'INSERT INTO '  . $this->table .  ' (`disc_title`, `disc_year`, `disc_picture`, `disc_label`, `disc_genre`, `disc_price`, `artist_id`) VALUES (:title, :year, :picture, :label, :genre, :price, :artist)';
        $result = $this->_con->prepare($query);
        $result->bindValue(':title', $this->disc_title, PDO::PARAM_STR);
        $result->bindValue(':year', $this->disc_year, PDO::PARAM_STR);
        $result->bindvalue(':picture', $this->disc_picture, PDO::PARAM_STR);
        $result->bindvalue(':label', $this->disc_label, PDO::PARAM_STR);
        $result->bindvalue(':genre', $this->disc_genre, PDO::PARAM_STR);
        $result->bindvalue(':price', $this->disc_price, PDO::PARAM_STR);
        $result->bindvalue(':artist', $this->artist_id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Suppression d'une ligne de la table disc
     * @param $disc_id
     * @return bool
     */
    public function delDisc($disc_id): bool
    {
        $query = 'DELETE FROM `disc` WHERE `disc`.`disc_id` = :disc_id';
        $result = $this->_con->prepare($query);
        $result->bindValue(':disc_id', $disc_id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * récupération des noms des disques
     * @param $title
     * @return mixed
     */
    public function getDiscByTitle($title)
    {
        $query = 'SELECT COUNT(*) FROM ' . $this->table . ' WHERE `disc_title` = :title';
        $result = $this->_con->prepare($query);
        $result->bindValue(':title', $title, PDO::PARAM_STR);
        $result->execute();
        return $result->fetch(PDO::FETCH_OBJ);
    }
}