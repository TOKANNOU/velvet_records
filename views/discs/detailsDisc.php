<!--
Page affichant les détails d'un disque
-->
<div class="container w-75">
    <?php
    /**
     * si la variable $success n'est pas vide (si la suppression d'un disque est confirmée),
     * affichage du message de confirmation de suppression
     * et d'un bouton de retour vers la page 'index'
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
                <a href="/discs/index" title="back to index page" class="btn btn-dark">Retour</a>
            </div>
        </div>
        <?php
    }
    // sinon affichage des détails d'un disque et gestion de sa suppression
    else
    {
        ?>
        <form action ="" method="POST" class="details">
            <div class="row">
                <div class="col-sm-5 offset-sm-1">
                    <h1 class="mb-3">Détails</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5 offset-sm-1">
                    <!-- Affichage des détails du disque sélectionné (accessible qu'en lecture) -->
                    <!-- Titre -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" class="form-control" name="title"
                               value="<?= isset($disc->disc_title)? $disc->disc_title : '' ?>" disabled>
                    </div>
                    <!-- Année -->
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="text" id="year" class="form-control" name="year"
                               value="<?= isset($disc->disc_year)? $disc->disc_year : '' ?>" disabled>
                    </div>
                    <!-- Label -->
                    <div class="mb-3">
                        <label for="label" class="form-label">Label</label>
                        <input type="text" id="label" class="form-control" name="label"
                               value="<?= isset($disc->disc_label)? $disc->disc_label : '' ?>" disabled>
                    </div>
                </div>
                <div class="col-sm-5">
                    <!-- Artiste -->
                    <div class="mb-3">
                        <label for="artist" class="form-label">Artist</label>
                        <input type="text" id="artist" class="form-control" name="artist"
                               value="<?= isset($disc->artist_name)? $disc->artist_name : '' ?>" disabled>
                    </div>
                    <!-- Genre -->
                    <div class="mb-3">
                        <label for="genre" class="form-label">Genre</label>
                        <input type="text" id="genre" class="form-control" name="genre"
                               value="<?= isset($disc->disc_genre)? $disc->disc_genre : '' ?>" disabled>
                    </div>
                    <!-- Prix -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <div class="input-group">
                            <input type="text" id="price" class="form-control" name="price"
                                   value="<?= isset($disc->disc_price)? $disc->disc_price : '' ?>" disabled>
                            <div class="input-group-append"><span class="input-group-text euroSymbol" aria-label="euro symbol">€</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5 offset-sm-1">
                    <!-- Affichage de l'image du disque sélectionné -->
                    <div>
                        <p class="mb-2">Picture</p>
                        <img src="<?= '/assets/pictures/' . ($disc->disc_picture) ?>"
                             class="img-fluid w-100" alt="<?= $disc->disc_title ?>" title="<?= $disc->disc_title ?>">
                    </div>

                    <!-- Boutons de contrôle -->
                    <div class="pt-3 mb-4 text-center">
                        <a href="/discs/updateDisc/<?= $disc->disc_id ?>" title="update button" class="btn btn-info formButton buttonSize p-1 mb-2">Modifier</a>
                        <a href="/discs/delDisc" title="delete button" class="btn btn-danger formButton buttonSize p-1 mb-2"
                           data-bs-toggle="modal" data-bs-target="#delModal<?= $disc->disc_id ?>">Supprimer</a>
                        <a href="/discs/index" title="back to index page" class="btn btn-secondary formButton buttonSize p-1 mb-2">Retour</a>
                    </div>
                </div>
            </div>

            <!-- Affichage d'un popup demandant la confirmation de suppression d'un disque -->
            <div class="modal fade" id="delModal<?= $disc->disc_id ?>" tabindex="-1"
                 aria-labelledby="delModal<?= $disc->disc_id ?>" aria-hidden="true">
                <!-- Début de la zone de dialogue -->
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Titre de suppression dans l'entête du modal -->
                        <div class="modal-header">
                            <p class="modal-title h5" id="delModal<?= $disc->disc_id ?>">Suppression du
                                disque <?= '"' . $disc->disc_title . '"' ?></p>
                            <!-- Bouton de fermeture du modal -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close" title="cancel button"></button>
                        </div>
                        <!-- Message de demande de confirmation dans le corps du modal -->
                        <div class="modal-body">
                            Etes-vous sûr de vouloir supprimer le disque <?= '"' . $disc->disc_title . '"' ?> ?
                        </div>
                        <!-- Boutons de contrôle -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary formButton" data-bs-dismiss="modal" title="cancel button">Annuler</button>
                            <a href="/discs/delDisc/<?= $disc->disc_id ?>" type="button"
                               class="btn btn-danger formButton" title="delete button">Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
    }
    ?>
</div>