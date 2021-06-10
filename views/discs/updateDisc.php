<!--
Page contenant le formulaire de mise à jour des données d'un disque
-->
<div class="container">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <?php
            /**
             * si la variable $success n'est pas vide (si tous les champs du formulaire sont bien renseignés),
             * affichage du message de confirmation de mise à jour des données du disque modifié
             * et d'un bouton de retour vers la page 'detailsDisc'
             */
            if (!empty($success)) {
                ?>
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">
                        <div class="alert alert-success text-center mt-4" role="alert">
                            <?= $success ?>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-sm-12 mt-2">
                        <a href="/discs/detailsDisc/<?= $disc->disc_id ?>" title="back to detailsDisc page" class="btn btn-dark">Retour</a>
                    </div>
                </div>
                <?php
            }
            // sinon vérification de tous les champs du formulaire de mise à jour
            else
            {
            ?>
            <form action ="/discs/updateDisc/<?= $disc->disc_id ?>" method="POST" class="details" enctype="multipart/form-data">
                <?php
                // s'il y a une erreur sur un champ du formulaire
                // affichage d'un message d'erreur
                if (!empty($error) || !empty($imgError)) {
                    ?>
                    <div class="row text-center">
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                <?= 'Veuillez renseigner tous les champs obligatoires !' ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                if (!empty($noUpdateMade)) {
                    ?>
                <div class="row text-center">
                    <div class="col-sm-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $noUpdateMade ?>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>

                <h1>Modifier un vinyle</h1>
                <!-- Champs du formulaire de mise à jour -->
                <!-- Titre -->
                <div class="mb-3 mt-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" id="title" class="form-control" name="title"
                           value="<?= isset($_POST['title']) ? $_POST['title'] : $disc->disc_title ?>">
                    <!-- Si le champ est vide, affichage d'un message d'erreur -->
                    <span class="error"><?= isset($error['title']) ? $error['title'] : '' ?></span>
                </div>
                <!-- Artiste -->
                <div class="mb-3">
                    <label for="artist" class="form-label">Artist</label>
                    <!-- Gestion de l'affichage de la liste d'artistes dans le sélecteur -->
                    <select class="form-select" aria-label="Default select example" id="artist" name="artist">
                        <!-- Première option désactivée -->
                        <option disabled>--Sélectionnez un artiste--</option>
                        <?php
                        // boucle permettant de parcourir le tableau contenant les noms des artistes
                        foreach ($artists as $artist) {
                            // seul le nom de l'artiste (selon artist_id) dont on veut modifier les données est maintenue
                            // dans le sélecteur avant la validation de la mise à jour
                            // **(problème à résoudre : s'il y a une erreur sur un autre champ, il faut que la dernière valeur sélectionnée dans le post soit maintenue)
                            ?>
                            <option value="<?= $artist->artist_id ?>" <?= ($artist->artist_id == $disc->artist_id) ? ' selected' : '' ?>><?= $artist->artist_name ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <!-- Si le champ est vide, affichage d'un message d'erreur -->
                    <span class="error"><?= isset($error['artist']) ? $error['artist'] : '' ?></span>
                </div>
                <!-- Année -->
                <div class="mb-3">
                    <label for="year" class="form-label">Year</label>
                    <input type="text" id="year" class="form-control" name="year"
                           value="<?= isset($_POST['year']) ? $_POST['year'] : $disc->disc_year ?>">
                    <!-- Si le champ est vide, affichage d'un message d'erreur -->
                    <span class="error"><?= isset($error['year']) ? $error['year'] : '' ?></span>
                </div>
                <!-- Genre -->
                <div class="mb-3">
                    <label for="genre" class="form-label">Genre</label>
                    <input type="text" id="genre" class="form-control" name="genre"
                           value="<?= isset($_POST['genre']) ? $_POST['genre'] : $disc->disc_genre ?>">
                    <!-- Si le champ est vide, affichage d'un message d'erreur -->
                    <span class="error"><?= isset($error['genre']) ? $error['genre'] : '' ?></span>
                </div>
                <!-- Label -->
                <div class="mb-3">
                    <label for="label" class="form-label">Label</label>
                    <input type="text" id="label" class="form-control" name="label"
                           value="<?= isset($_POST['label']) ? $_POST['label'] : $disc->disc_label ?>">
                    <!-- Si le champ est vide, affichage d'un message d'erreur -->
                    <span class="error"><?= isset($error['label']) ? $error['label'] : '' ?></span>
                </div>
                <!-- Prix -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <div class="input-group">
                        <input type="text" id="price" class="form-control" name="price"
                               value="<?= isset($_POST['price']) ? $_POST['price'] : $disc->disc_price ?>">
                        <div class="input-group-append"><span class="input-group-text euroSymbol" aria-label="euro symbol">€</span></div>
                    </div>
                    <!-- Si le champ est vide, affichage d'un message d'erreur -->
                    <span class="error"><?= isset($error['price']) ? $error['price'] : '' ?></span>
                </div>
                <!-- Ajout d'une image -->
                <div>
                    <label for="picture" class="form-label">Picture</label>
                    <input type="file" id="picture" class="form-inline" name="picture">
                    <!-- Si le champ est vide, affichage d'un message d'erreur -->
                    <span class="error"><?= isset($imgError['picture']) ? $imgError['picture'] : '' ?></span>
                </div>
                <!-- Affichage de l'image du disque à modifier -->
                <div class="row mb-3">
                    <div class="col-lg-5">
                        <div>
                            <img src="<?= '/assets/pictures/' . $disc->disc_picture ?>"
                                 class="img-fluid w-100" alt="<?= $disc->disc_title ?>" title="<?= $disc->disc_title ?>">
                        </div>
                    </div>
                </div>
                <!-- Boutons de contrôle -->
                <div class="mb-4">
                    <button type="submit" class="btn btn-info formButton mb-2" name="update" value="update" title="update button">Valider</button>
                    <a href="/discs/detailsDisc/<?= $disc->disc_id ?>" title="back to detailsDisc page" class="btn btn-secondary formButton mb-2">Annuler</a>
                </div>
            </form>
            <?php
            }
            ?>
        </div>
    </div>
</div>