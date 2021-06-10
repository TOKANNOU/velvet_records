<!--
Page affichant la liste des disques dans une carte Bootstrap
-->
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h1>Liste des disques (<?= count($discs) ?>)</h1>
        </div>
    </div>

    <!-- Affichage de la liste des enregistrements dans des cartes bootstrap -->
    <div class="row">
        <?php
        //Déclaration du chemin du répertoire où se trouve les images
        $directory = '/assets/pictures/';
        //Parcours du tableau "$discArray"
        foreach ($discs as $disc) { ?>
            <!-- Répartition de la page d'accueil en 3 colonnes pour l'affichage des tuples -->
            <div class="col-md-4 pt-4">
                <!-- Création d'une nouvelle carte à chaque tour de la boucle -->
                <div class="card border-0">
                    <!-- Répartition des images et des données des enregistrements en 2 colonnes -->
                    <div class="row no-gutters">
                        <!-- Première colonne -->
                        <div class="col-lg-5">
                            <!-- Affichage des images (concaténation du chemin du répertoire --
                                   -- avec les noms des images récupérés dans la base) -->
                            <img class="card-img img-fluid rounded w-100" src="<?= $directory . ($disc->disc_picture) ?>"
                                 alt="<?= $disc->disc_title ?>" title="<?= $disc->disc_title ?>">
                        </div>
                        <!-- Deuxième colonne -->
                        <div class="col-lg-7">
                            <div class="card-body ml-2 mt-1 p-0">
                                <!-- Affichages de tous les tuples nécessaires -->
                                <h3 class="card-title m-0"><?= $disc->disc_title ?></h3>
                                <p class="card-text"><b><?= $disc->artist_name ?></b></p>
                                <p class="card-text"><b>Label :</b><?= ' ' . $disc->disc_label ?></p>
                                <p class="card-text"><b>Year :</b><?= ' ' . $disc->disc_year ?></p>
                                <p class="card-text"><b>Genre :</b><?= ' ' . $disc->disc_genre ?></p>
                                <a href="/discs/detailsDisc/<?= $disc->disc_id ?>" class="btn btn-dark detailButton mt-3"
                                   title="go to detailsDisc page">Détails</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>