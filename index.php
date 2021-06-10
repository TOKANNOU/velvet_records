<?php
// définition const contenant chemin vers index.php
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
//die(ROOT);
require_once(ROOT . '/app/Model.php');
require_once(ROOT . '/app/AbstractController.php');
// récupération de l'url
$uri = $_SERVER['REQUEST_URI'];
// séparation des paramètres
$params = explode('/', $uri);

// vérification de l'existence du paramètre : 1 car l'url est récupérée sous la forme ''/texte/text
if ($params[1] != '') {
    // récupération du 1er paramètre => contrôleur
    $controller = ucfirst($params[1]);
    // récupération du 2e paramètre => méthode
    $action = isset($params[2]) ? $params[2] : 'index';
    // vérification de l'existence du contrôleur
    if (file_exists(ROOT . '/controllers/' . $controller . '.php')) {
        // récupération du controller demandé
        require_once(ROOT . '/controllers/' . $controller . '.php');
        if (file_exists(ROOT . 'entities/'. $controller .'Entity.php')) {
            require_once(ROOT . 'entities/'. $controller .'Entity.php');
        }

        // instantiation du contrôleur
        $controller = new $controller();
        // check si la method existe dans le contrôleur
        if (method_exists($controller, $action)) {
            // on retire les premiers paramêtres du tableau
            unset($params[0]);
            unset($params[1]);
            unset($params[2]);
//            Appelle une fonction de rappel avec les paramètres rassemblés en tableau
            call_user_func_array([$controller, $action], $params);
        } else {
            // code erreur 404 si la méthode n'est pas trouvée
            http_response_code(404);
            echo 'La méthode demandée n\'existe pas';
        }
    } else {
        // code erreur 404 sir le contrôleur n'est pas trouvé
        http_response_code(404);
        echo 'La page demandée n\'existe pas';
    }
} else {
    // affichage de page 'homePage'
    header('Location: \discs\homePage');
}