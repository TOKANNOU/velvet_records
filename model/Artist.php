<?php


class Artist extends Model
{
    /**
     * stockage de la table 'artist' dans un objet et connexion à la bdd 'record'
     */
    public function __construct()
    {
        $this->table = 'artist';
        $this->getConnection();
    }

}