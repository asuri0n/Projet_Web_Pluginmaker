<?php

    if (!isset($params[1]) or !is_numeric($params[1])) {
        $_SESSION["error"] = "Erreur chargement de la page";
        session_write_close();
        header("Location: ".WEBROOT."plugins");
    }

    $sql = "SELECT * FROM plugin JOIN categorie USING(categorie_id) WHERE plugin_id=:id";
    $row = $pdo->row($sql,array("id"=>$params[1]));

    if (!$row) {
        $_SESSION["error"] = "Le plugin n'existe pas";
        session_write_close();
        header("Location: ".WEBROOT."plugins");
    }

    $page = "plugin";
    $title = "Détails sur un Plugin.";

?>

<section class="breadCrumArea">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <h1 class="wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">Détails sur un <span>plugin</span></h1>
                <ul class="breadLink wow fadeInUp" data-wow-duration="700ms" data-wow-delay="350ms">
                    <li><a href="accueil">Accueil</a><span>|</span></li>
                    <li><a href="plugins">Mes plugins</a><span>|</span></li>
                    <li>Détails</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="folioItemArea commonSection">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <div class="folioItem">
                    <div class="folioItemImg wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">
                        <img style="text-align: center; width: 200px !important;" src="<?= $row['plugin_picture'] ?>" alt="">
                    </div>
                    <div class="folioItemContent wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">
                        <h2><?= $row['plugin_title'] ?></h2>
                        <p class="potCategory"><?= $row['categorie_title'] ?></p>
                        <p>
                            <?= $row['plugin_description'] ?>
                        </p>
                        <br>
                        <h3 style="color:salmon">
                            Prix : <?= $row['plugin_price']."€" ?>
                        </h3>
                        <br>
                        <?php if(isset($_SESSION['Auth'])) { ?>
                            <?php if($row['plugin_price'] != 0) { ?>
                                <form action="https://www.sandbox.paypal.com/fr/cgi-bin/webscr" method="post">
                                    <?php if(isset($nomCoupon)) { ?>
                                        <input type="hidden" name="custom" value="<?php echo $_SESSION['Auth']['id'].'//'.$params[1].'//'.$numCoupon ?>">
                                    <?php } else { ?>
                                        <input type="hidden" name="custom" value="<?php echo $_SESSION['Auth']['id'].'//'.$params[1] ?>">
                                    <?php } ?>
                                    <input type="hidden" name="business" value="pluginmakerfr-facilitator@gmail.com">
                                    <input type="hidden" name="item_name" value="<?php echo $row['plugin_title'] ?>">
                                    <input type="hidden" name="cmd" value="_xclick">
                                    <input type="hidden" name="currency_code" value="EUR">
                                    <input type="hidden" name="amount" value="<?php echo (isset($newPrix)) ? $newPrix : $row['plugin_price'] ?>">
                                    <input type="image" src="/images/PayButton.png" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
                                </form>
                            <?php } else { ?>
                                <a href="/dwl/<?= $params[1] ?> " type="button" class="btn btn-primary btn-lg">Télécharger</a>
                            <?php } ?>
                        <?php } else { ?>
                            <h4>Veuillez vous connecter pour télécharger le plugin</h4>
                        <?php } ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>

