<?php


/**
 * Class Discs
 */
class Discs extends AbstractController
{
    /**
     * affichage en carrousel de la liste des discs sur la page 'homePage'
     */
    public function homePage()
    {
        // accès à la méthode loadModel() de abstractController, qui permet de charger le model voulu
        $disc = $this->loadModel('Disc');
        // appel de la méthode getDiscsInformations()
        $discList = $disc->getDiscsInformations();
        // envoi des données vers la vue 'homePage'
        $this->render('homePage', ['discs' => $discList]);
    }

    /**
     * affichage de la liste des discs dans des cartes bootstrap sur la page 'index'
     */
    public function index()
    {
        // accès à la méthode loadModel() de abstractController qui permet de charger le model voulu
        $disc = $this->loadModel('Disc');
        // appel de la méthode getDiscsInformations()
        $discList = $disc->getDiscsInformations();
        // envoi des données vers la vue 'index'
        $this->render('index', ['discs' => $discList]);
    }

    /**
     * affichage du détail d'un disque selon son id sur la page 'detailsDisc'
     * @param $disc_id
     */
    public function detailsDisc($disc_id)
    {
        // chargement des models
        $disc = $this->loadModel('Disc');
        $artist = $this->loadModel('Artist');
        // appel de la méthode permettant l'affichage des différentes données
        $oneDisc = $disc->getOneDiscById($disc_id);

        // envoi des données vers la vue 'detailsDisc'
        $this->render('detailsDisc', [
            'disc' => $oneDisc
        ]);
    }

    /**
     * validation du formulaire de modification d'un disque selon son id sur la page 'updateDisc'
     * @param $disc_id
     */
    public function updateDisc($disc_id)
    {
        // définitions des tableaux d'erreur et d'une variable de confirmation de l'update
        $formError = [];
        $imgError = [];
        $success = '';
        $noUpdateMade = '';

        // chargement des models
        $disc = $this->loadModel('Disc');
        $artist = $this->loadModel('Artist');
        // appel des méthodes permettant l'affichage des différentes données
        $allArtist = $artist->getAll();
        $oneDisc = $disc->getOneDiscById($disc_id);

        // si le formulaire est validé
        if (isset($_POST['update'])) {
            // définition d'un tableau associatif contenant les regex
            $regex = [
                'title' => '/^[\w\s\/\,\.]+$/',
                'artist' => '/^[\w\s\/\,\.]+$/',
                'year' => '/^[1-2]{1}[0-9]{3}$/',
                'genre' => '/^[\w\s\/\,\.]+$/',
                'label' => '/^[\w\s\/\,\.]+$/',
                'price' => '/^\d+[\.]?\d+?$/'
            ];
            // appel de la méthode validForm de l'AbstractController permettant la validation du formulaire
            // et la génération d'éventuels messages d'erreur (stockage du retour dans une variable)
            $formError = $this->validForm($_POST, $regex);

            // s'il y a une image à uploader
            if($_FILES['picture']['name'] != '') {
                // appel de la méthode validImg pour la vérification de l'upload
                $imgError = $this->validImg($_FILES, 'picture');
                // s'il n'y a pas d'erreur lors d'un éventuel upload
                if(count($imgError) === 0) {
                    // renommage de l'image par le nom du titre
                    // récupération de l'extension à partir de la fin du nom de l'image jusqu'au '.'
                    $renamedFile = ucwords($_POST['title']) . strtolower(strrchr($_FILES['picture']['name'], '.'));

                    // si l'image du disque existe déjà dans le répertoire personnel
                    if (file_exists(ROOT . '/assets/pictures/' . $renamedFile)) {
                        // suppression de l'image du répertoire
                        unlink(ROOT . '/assets/pictures/' . $renamedFile);
                    }
                    // transfert de l'image du répertoire temporaire vers le répertoire personnel
                    move_uploaded_file($_FILES['picture']['tmp_name'], ROOT . '/assets/pictures/' . $renamedFile);
                    // prise en compte de l'image renommée
                    $disc->setDiscPicture($renamedFile);
                    // enregistrement du nom de l'image dans la bdd 'record'
                    $disc->updatePicture($disc_id);
                }
            }

            // s'il n'y a pas d'erreur sur tous les champs du formulaire
            if (count($formError) === 0) {
                // appel des méthodes setters de DiscsEntity
                // prise en compte des éventuelles modifications des champs suivants
                $disc->setDiscTitle(ucwords($_POST['title']));
                $disc->setDiscYear($_POST['year']);
                $disc->setDiscLabel(ucwords($_POST['label']));
                $disc->setDiscGenre(ucwords($_POST['genre']));
                $disc->setDiscPrice($_POST['price']);
                $disc->setDiscArtist($_POST['artist']);

                // enregistrement des éventuelles modifications de tous les autres champs du formulaire
                $disc->updateDisc($disc_id);
                // message de confirmation de la mise à jour
                $success = 'Mise à jour réussie !!!';
            }
        }
        // envoi des données vers la vue 'updateDisc'
        $this->render('updateDisc', [
            'disc' => $oneDisc,
            'artists' => $allArtist,
            'error' => $formError,
            'imgError' => $imgError,
            'noUpdateMade' => $noUpdateMade,
            'success' => $success
        ]);
    }

    /**
     * validation du formulaire d'ajout d'un nouveau disque sur la page 'addDisc'
     */
    public function addDisc()
    {
        // définitions des tableaux d'erreur et d'une variable de confirmation de l'ajout
        $formError = [];
        $imgError = [];
        $success = '';
        // chargement des models
        $disc = $this->loadModel('Disc');
        $artist = $this->loadModel('Artist');
        // appel de la méthode permettant l'affichage des différentes données
        $allArtist = $artist->getAll();

        // si le formulaire est validé
        if (isset($_POST['add'])) {
            // définition d'un tableau associatif contenant les regex
            $regex = [
                'title' => '/^[\w\s\/\,\.]+$/',
                'artist' => '/^[\w\s\/\,\.]+$/',
                'year' => '/^[1-2]{1}[0-9]{3}$/',
                'genre' => '/^[\w\s\/\,\.]+$/',
                'label' => '/^[\w\s\/\,\.]+$/',
                'price' => '/^\d+[\.]?\d+?$/'
            ];

            // appel de la méthode validForm permettant la validation du formulaire
            // et la génération d'éventuels messages d'erreur (stockage du retour dans une variable)
            $formError = $this->validForm($_POST, $regex);

            // appel de la méthode validImg pour le contrôle de l'upload
            $imgError = $this->validImg($_FILES, 'picture');

            // s'il n'y a pas d'erreur sur tous les champs du formulaire
            if (count($formError) === 0 && count($imgError) === 0) {
                // accès aux mutateurs
                $disc->setDiscTitle(ucwords($_POST['title']));
                $disc->setDiscYear($_POST['year']);
                $disc->setDiscLabel(ucwords($_POST['label']));
                $disc->setDiscGenre(ucwords($_POST['genre']));
                $disc->setDiscPrice($_POST['price']);
                $disc->setDiscArtist($_POST['artist']);

                // renommage de l'image par le nom du titre
                // récupération de l'extension à partir de la fin du nom de l'image jusqu'au '.'
                $renamedFile = ucwords($_POST['title']) . strtolower(strrchr($_FILES['picture']['name'], '.'));
                // transfert de l'image du répertoire temporaire vers le répertoire personnel
                move_uploaded_file($_FILES['picture']['tmp_name'], ROOT . '/assets/pictures/' . $renamedFile);
                // prise en compte de l'image renommée
                $disc->setDiscPicture($renamedFile);
                // enregistrement de l'ajout du disque dans la bdd 'record'
                $disc->addDisc();
                // message de confirmation de l'ajout
                $success = 'Disque ajouté avec succès !!!';
            }
        }
        // envoi des données vers la vue 'addDisc'
        $this->render('addDisc', [
            'artists' => $allArtist,
            'error' => $formError,
            'imgError' => $imgError,
            'success' => $success
        ]);
    }

    /**
     * suppression d'un disque selon son id sur la page 'detailsDisc'
     * @param $disc_id
     */
    public function delDisc($disc_id)
    {
        // définition des variables de confirmation ou d'érreur de suppression
        $success = '';
        $error = '';
        // accès à la méthode loadModel() de l'AbstractController, qui permet de charger le model voulu
        $disc = $this->loadModel('Disc');
        // récupération des données d'un disque selon son id
        $oneDisc = $disc->getOneDiscById($disc_id);
        // récupération du nom de l'image
        $discPicture = $oneDisc->disc_picture;
        // si on confirme la suppression du disque
        if ($disc->delDisc($disc_id)) {
            // si l'image du disque existe déjà dans le répertoire personnel
            if (file_exists(ROOT . '/assets/pictures/' . $discPicture)) {
                // suppression de l'image du répertoire
                unlink(ROOT . '/assets/pictures/' . $discPicture);
            }
            // envoi d'un message de confirmation de la suppression
            $success = 'Disque supprimé avec succès  !!!';
        } else {
            $error = 'Erreur lors de la suppression !'; // sinon envoi d'un message d'erreur
        }
        // appel de la méthode getDiscsInformations()
        $discsList = $disc->getDiscsInformations();
        // envoie des données vers la vue 'detailsDisc'
        $this->render('detailsDisc', [
            'discs' => $discsList,
            'success' => $success,
            'error' => $error
        ]);
    }

    /**
     * gestion de l'existence d'un disque dans la bdd lors de l'ajout d'un nouveau (à gérer avec ajax)
     * @param $title
     */
    public function getDiscByTitle($title) {
        $disc = $this->loadModel('Disc');
        $discTitle = $disc->getDiscByTitle($title);
        if ($discTitle >= 1) {
            echo 'Ce disque existe déjà dans la base';
        }
    }
}