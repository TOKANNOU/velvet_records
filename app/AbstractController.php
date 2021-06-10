<?php


abstract class AbstractController
{
    /**
     * fonction permettant l'instanciation d'un model
     * @param string $model
     * @return mixed
     */
    public function loadModel(string $model)
    {
        require_once(ROOT . '/model/' . $model . '.php');
        // retour de l'instance du model
        return new $model();
    }

    /**
     * affichage d'une vue, avec paramètre
     * @param string $file
     * @param array $data
     */
    public function render(string $file, array $data = [])
    {
        // création d'une variable selon la clé associative
        extract($data);
        // on démarre le buffer
        ob_start();
        require_once(ROOT . '/views/' . strtolower(get_class($this)) . '/' . $file . '.php');
        // on récupère ce qu'il y a dans le buffer
        $content = ob_get_clean();
        require_once(ROOT . '/views/layout/default.php');
    }

    /**
     * fonction de validation de formulaire qui prend en paramètres
     * les données envoyées en post et les regex contenus dans un tableau
     * @param array $post
     * @param array $regex
     * @return array
     */
    public function validForm(array $post, array $regex): array
    {
        // déclaration d'un tableau d'erreur
        $formError = [];
        // boucle permettant de parcourir le tableau contenant les regex
        foreach ($regex as $key => $value) {
            // si le post n'est pas vide
            if (!empty($post[$key])) {
                // si la valeur du post ne correspond pas à la regex
                if (!preg_match($value, $post[$key])) {
                    // envoi du message d'erreur
                    $formError[$key] = '*Erreur sur le champ ~' . ucfirst($key) . '~';
                }
            } else {
                // envoi du message d'erreur
                $formError[$key] = '*Veuillez remplir le champ ~' . ucfirst($key) . '~';
            }
        }
        return $formError;
    }

    /**
     * fonction de validation d'upload d'images qui prend en paramètres
     * les données envoyées en files et la variable du fichier téléchargé filename
     * @param array $files
     * @param string $fileName
     * @return array
     */
    public function validImg(array $files, string $fileName): array
    {
        // déclaration d'un tableau d'erreur
        $imgError = [];
        // déclaration d'un tableau contenant les extensions autorisées
        $aMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/jpg");

        // si l'image est présente
        if(!empty($files[$fileName]['name']) && isset($files[$fileName])) {
            // s'il n'y a aucune erreur lors de l'upload
            if ($files[$fileName]['error'] === 0) {
                /* Ouverture d'une base de données magique qui retourne le type mime d'un fichier */
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                // récupération du type mime du fichier
                $mimetype = finfo_file($finfo, $files[$fileName]['tmp_name']);
                /* fermeture de la connexion à la base de données */
                finfo_close($finfo);
                // si l'extension (le type mime) est dans le tableau
                if (in_array($mimetype, $aMimeTypes)) {
                    // vérification de la taille de l'image
                    if ($files[$fileName]['size'] > 900000) {
                        $imgError[$fileName] = '*Votre image est trop volumineuse (taille maximale autorisée : 900Ko)';
                    }
                } else {
                    // envoi du message d'erreur
                    $imgError[$fileName] = '*Format d\'image incorrect (format valide : gif, jpeg, png, pjeg)';
                }
            // sinon si aucune image n'a été téléchargée
            } elseif ($files[$fileName]['error'] === 4) {
                // envoi du message d'erreur
                $imgError[$fileName] = '*Une image est requise';
            } else {
                // envoi du message d'erreur de problème inconnu
                $imgError[$fileName] = '*Une erreur est survenue lors du téléchargement. Veuillez recommencer svp !';
            }
        } else {
            //envoi du message d'erreur
            $imgError[$fileName] = '*Veuillez ajouter une image';
        }
        return $imgError;
    }
}
