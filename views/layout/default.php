<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Velvet Records</title>
</head>
<body>
    <?php
        /**
         * repérage des différentes pages du menu navbar
         * récupération de l'URL de la page pour l'affecter à la class 'active' des liens du navbar
         */
        $page = $_SERVER['REQUEST_URI'];
        $page = str_replace('/discs/detailsDisc','', $page);
    ?>
    <header>
        <!-- Bar de navigation en entête de page -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand mb-2" href="/discs/homePage" title="go to home page">Velvet Records</a>
                <button class="navbar-toggler ml-4 mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" title="navbar toggler">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <!-- En cliquant sur un des liens du menu, on récupère la class active -->
                        <li class="nav-item ml-4 <?= ($page == '/discs/homePage') ? ' active' : '' ?>">
                            <a class="nav-link" href="/discs/homePage" title="go to home page">ACCUEIL<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item ml-4 <?= ($page == '/discs/index') ? ' active' : '' ?>"">
                            <a class="nav-link" href="/discs/index" title="go to index page">CATALOGUE</a>
                        </li>
                        <li class="nav-item ml-4 <?= ($page == '/discs/addDisc') ? ' active' : '' ?>"">
                        <a class="nav-link" href="/discs/addDisc" title="go to index page">AJOUTER UN DISQUE</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit" title="search button">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <!-- affichage des informations du buffer (page d'une vue en fonction des liens de navigation) -->
    <?= $content ?>

    <footer>
        <!-- Bar de navigation en pieds de page -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-bottom">
            <button class="navbar-toggler ml-4 mb-2" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" title="navbar toggler">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item ml-4">
                        <a class="nav-link" href="" title="legal notice">MENTION LÉGALES</a>
                    </li>
                    <li class="nav-item ml-4">
                        <a class="nav-link" href="" title="timetable">HORAIRES</a>
                    </li>
                    <li class="nav-item ml-4">
                        <a class="nav-link" href="" title="sitemap">PLAN DU SITE</a>
                    </li>
                </ul>
            </div>
        </nav>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <!--<script src="../../assets/js/script.js"></script>-->
</body>
</html>
