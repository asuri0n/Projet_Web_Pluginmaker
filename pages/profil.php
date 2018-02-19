<?php

    if ( !isset($_SESSION['Auth']['id'])) { header("Location: accueil"); }

    $page = "profil";
    $title = "Mon profil.";

?>

<section class="breadCrumArea">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <h1 class="wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">Mon <span>profil</span></h1>
                <ul class="breadLink wow fadeInUp" data-wow-duration="700ms" data-wow-delay="350ms">
                    <li><a href="accueil">Accueil</a><span>|</span></li>
                    <li>Mon profil</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="folioItemArea commonSection">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">

            </div>
        </div>
    </div>
</section>
