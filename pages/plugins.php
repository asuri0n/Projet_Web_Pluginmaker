<?php
    $page = "creation";
    $title = "Mes créations.";

    $getCategories = "SELECT categorie_name, categorie_title FROM categorie";
    $rows = $pdo->query($getCategories);

    $categories = "";
    foreach ( $rows as $categorie) {
        $categories .= '<li class="filter" data-filter="'.$categorie['categorie_name'].'">'.$categorie['categorie_title'].'</li>';
    }

    $getPlugins = "SELECT * FROM plugin JOIN categorie USING(categorie_id)";
    $rows = $pdo->query($getPlugins);

    $plugins = "";
    foreach ( $rows as $plugin) {
        $plugins .= '
            <div class="col-lg-2 col-sm-6 col-xs-12 text-center mix '.$plugin['categorie_name'].'">
                <div class="folioImg">
                    <img src="'.$plugin['plugin_picture'].'" alt="">
                    <div class="folioHover2 dirHov">
                        <p class="pluginTitle">'.$plugin['plugin_title'].'</p>
                        <a class="prePhoto" href="'.$plugin['plugin_link'].'"><i class="fa fa-download"></i></a>
                        <a href="/plugin/'.$plugin['plugin_id'].'" class="detailsLink"><i class="fa fa-info"></i></a>
                    </div>
                </div>
            </div>
        ';
    }
?>

<section class="breadCrumArea">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <h1 class="wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">Nos <span>plugins</span></h1>
                <ul class="breadLink wow fadeInUp" data-wow-duration="700ms" data-wow-delay="350ms">
                    <li><a href="accueil">Accueil</a><span>|</span></li>
                    <li>Nos plugins</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="portfolioArea commonSection folioPage">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">
                <ul class="folioBtn text-center">
                    <?= $categories ?>
                </ul>
            </div>
        </div>
        <div class="row">
            <div id="mixer" class="folioPage">
                <?= $plugins ?>
            </div>
        </div>
    </div>
</section>
