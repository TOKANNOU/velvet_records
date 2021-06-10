<!--
Page contenant le formulaire d'ajout d'un nouveau disque
-->
<div class="container">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <?php
            /**
             * si la variable $success n'est pas vide (si tous les champs du formulaire sont bien renseignés),
             * affichage du message de confirmation d'ajout du nouveau disque
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
            // sinon vérification de tous les champs du formulaire d'ajout d'un disque
            else
            {
            ?>
            <form action ="/discs/addDisc/" method="POST" class="details" enctype="multipart/form-data">
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
                ?>
                <h1>Ajouter un vinyle</h1>
                <!-- Champs du formulaire d'ajout -->
                <!-- Titre -->
                <div class="mb-3 mt-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" id="title" class="form-control" name="title"
                           value="<?= isset($_POST['title']) ? $_POST['title'] : '' ?>" placeholder="Ajoutez un titre">
                    <!-- Si le champ est vide, affichage d'un message d'erreur -->
                    <span class="error" id="errorTitle"><?= isset($error['title']) ? $error['title'] : '' ?></span>
                </div>
                <!-- Artiste -->
                <div class="mb-3">
                    <label for="artist" class="form-label">Artist</label>
                    <!-- Gestion de l'affichage de la liste d'artistes dans le sélecteur -->
                    <select class="form-select" aria-label="Default select example" id="artist" name="artist">
                        <!-- Première option sélectionnée et désactivée par défaut -->
                        <option selected disabled>--Sélectionnez un artiste--</option>
                        <?php
                        // boucle permettant de parcourir le tableau contenant les noms des artistes
                        foreach ($artists as $artist) {
                            // si un artiste est sélectionné, $selected vaut ' selected' sinon rien (option 1 par défaut)
                            $artist->artist_id == $_POST['artist'] ? $selected = ' selected' : $selected = '';
                            // pour les autres options de la boucle,
                            // le nom de l'artiste est maintenue en fonction de la valeur de $selected
                            ?>
                            <option value="<?= $artist->artist_id ?>" <?= $selected ?>><?= $artist->artist_name ?></option>
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
                           value="<?= isset($_POST['year']) ? $_POST['year'] : '' ?>" placeholder="Ajoutez une année">
                    <!-- Si le champ est vide, affichage d'un message d'erreur -->
                    <span class="error"><?= isset($error['year']) ? $error['year'] : '' ?></span>
                </div>
                <!-- Genre -->
                <div class="mb-3">
                    <label for="genre" class="form-label">Genre</label>
                    <input type="text" id="genre" class="form-control" name="genre"
                           value="<?= isset($_POST['genre']) ? $_POST['genre'] : '' ?>"
                           placeholder="Ajoutez un genre (Rock, Pop, Prog ...)">
                    <!-- Si le champ est vide, affichage d'un message d'erreur -->
                    <span class="error"><?= isset($error['genre']) ? $error['genre'] : '' ?></span>
                </div>
                <!-- Label -->
                <div class="mb-3">
                    <label for="label" class="form-label">Label</label>
                    <input type="text" id="label" class="form-control" name="label"
                           value="<?= isset($_POST['label']) ? $_POST['label'] : '' ?>"
                           placeholder="Ajoutez un label (EMI, Warner, PolyGram, Univers sale ...)">
                    <!-- Si le champ est vide, affichage d'un message d'erreur -->
                    <span class="error"><?= isset($error['label']) ? $error['label'] : '' ?></span>
                </div>
                <!-- Prix -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <div class="input-group">
                        <input type="text" id="price" class="form-control" name="price"
                               value="<?= isset($_POST['price']) ? $_POST['price'] : '' ?>">
                        <div class="input-group-append"><span class="input-group-text euroSymbol" aria-label="euro symbol">€</span></div>
                    </div>
                    <!-- Si le champ est vide, affichage d'un message d'erreur -->
                    <span class="error"><?= isset($error['price']) ? $error['price'] : '' ?></span>
                </div>

                <!-- Ajout d'une image -->
                <div class="mb-3">
                    <label for="picture" class="form-label">Picture</label>
                    <input type="file" id="picture" class="form-inline" name="picture">
                    <!-- Si le champ est vide, affichage d'un message d'erreur -->
                    <span class="error"><?= isset($imgError['picture']) ? $imgError['picture'] : '' ?></span>
                </div>

                <!-- Boutons de contrôle -->
                <div class="mb-5 pb-5">
                    <button type="submit" class="btn btn-info formButton mb-2" name="add" value="add" title="add button">Valider</button>
                    <a href="/discs/homePage" title="back to index page" class="btn btn-secondary formButton mb-2">Annuler</a>
                </div>
            </form>
            <?php
            }
            ?>
        </div>
    </div>
</div>


