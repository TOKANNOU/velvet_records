<!--
Page d'accueil contenant des informations sur l'entreprise et
un carousel affichant la liste des disques et
la possibilité d'accéder à leurs détails en cliquant sur une image
-->
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <section class="mb-4">
                <!-- Article sur les différentes catégories -->
                <h1 class="mb-3">Catégories</h1>
                <article class="text-justify">
                    <p>Dolor deserunt provident harum, blanditiis iste dignissimos, soluta ex at maiores itaque quasi alias nemo ratione.</p>
                    <p>Dolor deserunt provident harum, blanditiis iste dignissimos, soluta ex at maiores itaque quasi alias nemo ratione.</p>
                    <p>Dolor deserunt provident harum, blanditiis iste dignissimos, soluta ex at maiores itaque quasi alias nemo ratione.</p>
                    <p>Dolor deserunt provident harum, blanditiis iste dignissimos, soluta ex at maiores itaque quasi alias nemo ratione.</p>
                </article>
            </section>
        </div>
        <div class="col-lg-6">
            <h1 class="mb-4">Meilleurs ventes</h1>
            <!-- Carousel d'images (vitesse de défilement des images configurée à 3s)-->
            <div id="discImageCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="3000">
                <!-- Indicateurs de l'affichage -->
                <ol class="carousel-indicators">
                    <?php
                    //Parcours du tableau "$disc"
                    foreach ($discs as $disc) { ?>
                        <!--
                        Défilement des images à partir de l'image active
                        Si disc_id vaut '4', l'image défile à partir de ce numéro d'identifiant
                        -->
                        <li data-target="#discImageCarousel" data-slide-to="<?= $disc->disc_id ?>"
                            class="<?= ($disc->disc_id === '4') ? 'active' : '' ?>"></li>
                        <?php
                    }
                    ?>
                </ol>

                <!-- Affichage des images dans le carousel -->
                <div class="carousel-inner rounded mb-4">
                    <?php
                    //Parcours du tableau '$disc'
                    foreach ($discs as $disc) { ?>
                            <!-- Si disc_id vaut '4', l'image s'affiche à partir de ce numéro d'identifiant -->
                        <div class="carousel-item <?= ($disc->disc_id === '4') ? ' active' : '' ?>">
                            <!-- On rentre sur la page du carousel -->
                            <div class="carousel-page">
                                <!-- Affichage des images dans un bonton qui mène aux détails de chaque disc -->
                                <a href="/discs/detailsDisc/<?= $disc->disc_id ?>" title="go to detailsDisc page">
                                        <img class="carImg" src="<?= '/assets/pictures/' . ($disc->disc_picture) ?>"
                                             alt="<?= $disc->disc_title ?>"
                                             title="Cliquez pour accéder aux détails du disque ~<?= $disc->disc_title ?>~">
                                </a>
                            </div>
                            <!-- Affichage du titre des images -->
                            <div class="carousel-caption p-0">
                                <p class="carouselTitle"><?= $disc->disc_title ?></p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <!-- Boutons de contrôle du défilement des images -->
                <a class="carousel-control-prev" href="#discImageCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Précédent</span>
                </a>
                <a class="carousel-control-next" href="#discImageCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Suivant</span>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <section class="mb-4">
                <h1  class="mb-3">Partenaires</h1>
                <!-- Article sur les partenaires -->
                <article class="text-justify">
                    <p>Dolor deserunt provident harum, blanditiis iste dignissimos, soluta ex at maiores itaque quasi alias nemo ratione.</p>
                    <p>Dolor deserunt provident harum, blanditiis iste dignissimos, soluta ex at maiores itaque quasi alias nemo ratione.</p>
                    <p>Dolor deserunt provident harum, blanditiis iste dignissimos, soluta ex at maiores itaque quasi alias nemo ratione.</p>
                    <p>Dolor deserunt provident harum, blanditiis iste dignissimos, soluta ex at maiores itaque quasi alias nemo ratione.</p>
                </article>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <section class="mb-4">
                <h1 class="mb-3">Livraison</h1>
                <!-- Article sur les modes de livraison -->
                <article class="text-justify">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita magnam ad recusandae consequatur. Dolor deserunt provident harum, blanditiis iste dignissimos, soluta ex at maiores itaque quasi alias nemo ratione.</p>
                    <p>Velit quaerat eius neque. Cupiditate officia aut ut enim minima dicta consequuntur iusto. Esse id molestias. Veniam odio consequatur aperiam fugit, nemo distinctio maxime explicabo autem corrupti, vero officia.</p>
                </article>
            </section>
        </div>
    </div>
</div>