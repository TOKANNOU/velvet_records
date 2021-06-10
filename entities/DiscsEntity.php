<?php


class DiscsEntity extends Model {

    public string $disc_id;

    public string $disc_title;

    public string $disc_year;

    public string $disc_picture;

    public string $disc_label;

    public string $disc_genre;

    public string $disc_price;

    public int $artist_id;

    // les getters renvoient la valeur d'un attribut
    // l'accesseur "getDiscId" renvoie la valeur de "disc_id"
    public function getDiscId(): int
    {
        return $this->disc_id;
    }
    // l'accesseur "getDiscTitle" renvoie la valeur de "disc_title"
    public function getDiscTitle(): string
    {
        return $this->disc_title;
    }

    // les setters définissent/modifient la valeur passée en argument à l'attribut
    // le mutateur "setDiscTitle" définit/modifie la valeur passée en argument à "$title"
    public function setDiscTitle(string $title)
    {
        $this->disc_title = $title;
        return $this;
    }

    public function getDiscYear(): string
    {
        return $this->disc_year;
    }

    public function setDiscYear(string $year) {
        $this->disc_year = $year;
        return $this;
    }

    public function getDiscPicture(): string
    {
        return $this->disc_picture;
    }

    public function setDiscPicture(string $picture)
    {
        $this->disc_picture = $picture;
        return $this;
    }

    public function getDiscLabel(): string
    {
        return $this->disc_label;
    }

    public function setDiscLabel(string $label)
    {
        $this->disc_label = $label;
        return $this;
    }

    public function getDiscGenre(): string
    {
        return $this->disc_genre;
    }

    public function setDiscGenre(string $genre)
    {
        $this->disc_genre = $genre;
        return $this;
    }

    public function getDiscPrice(): string
    {
        return $this->disc_price;
    }

    public function setDiscPrice(string $price)
    {
        $this->disc_price = $price;
        return $this;
    }

    public function getDiscArtist(): int
    {
        return $this->artist_id;
    }

    public function setDiscArtist(int $artist_id)
    {
        $this->artist_id = $artist_id;
        return $this;
    }
}