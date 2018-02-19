<?php
    $page = "home";
    $title = "Création de plugins Minecraft sur-mesure.";

    $getSkills = "SELECT * FROM skill";
    $rows = $pdo->query($getSkills);
    $skills = "";
    foreach ( $rows as $skill) {
        $skills .= '
            <div class="col-lg-4 col-sm-12 col-xs-12 text-center">
                <div class="singleSkill wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">
                    <div class="'.$skill['skill_name'].' cmskill" data-skills="'.$skill['skill_pourcent'].'" data-gradientstart="#E7A768" data-gradientend="#E7A768"><strong></strong></div>
                    <p>'.$skill['skill_title'].'</p>
                </div>
            </div>
        ';
    }

    $getFeatures = "SELECT * FROM feature";
    $rows = $pdo->query($getFeatures);
    $features = "";
    foreach ( $rows as $feature) {
        $features .= '
            <div class="col-lg-3 col-sm-6 col-xs-12 text-center wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">
                <div class="featureImg">
                    <img src="'.$feature['feature_picture'].'" alt="">
                </div>
                <div class="featureContent">
                    <h3><a href="#">'.$feature['feature_title'].'</a></h3>
                    <p>'.$feature['feature_description'].'</p>
                </div>
            </div>
        ';
    }

    $getSlides = "SELECT * FROM slide JOIN new USING(new_id)";
    $rows = $pdo->query($getSlides);
    $slides = "";
    foreach ( $rows as $slide) {
        $slides .= '
            <li data-slotamount="7" data-masterspeed="1000" >
                <img src="images/home1/slider1.jpg"  alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                <div class="tp-caption lightgrey_divider lft fadeout"
                     data-x="left"
                     data-y="235"
                     data-speed="1400"
                     data-start="1300"
                     data-easing="Power4.easeOut">
                    <p class="redCaption">Nouveauté du '.date('d/m/Y',strtotime($slide['new_date'])).'.</p>
                </div>
                <div class="tp-caption lightgrey_divider lfr fadeout"
                     data-x="left"
                     data-y="266"
                     data-speed="1400"
                     data-start="1300"
                     data-easing="Power4.easeOut">
                    <h1 class="headCaption">'.$slide['slide_title1'].' <span>'.$slide['slide_title2'].'</span></h1>
                </div>
                <div class="tp-caption lightgrey_divider lfl fadeout"
                     data-x="left"
                     data-y="395"
                     data-speed="1400"
                     data-start="1300"
                     data-easing="easeInOutElastic">
                    <p class="capItalic">
                        '.$slide['slide_description'].'
                    </p>
                </div>
                <div class="tp-caption lightgrey_divider lfb fadeout"
                     data-x="left"
                     data-y="460"
                     data-speed="1400"
                     data-start="1300"
                     data-easing="Power4.easeOut">
                    <a href="#" class="sliderBtn"><i class="icon-bulb"></i><span>Voir plus</span></a>
                </div>
                <div class="tp-caption lightgrey_divider lft resFix fadeout"
                     data-x="right"
                     data-y="75"
                     data-speed="1400"
                     data-start="1300"
                     data-easing="easeOutBack">
                    <div class="sliderImg">
                        <img src="'.$slide['slide_picture'].'" alt="ThemeWar">
                    </div>
                </div>
            </li>
        ';
    }

    $getPlugins = "SELECT * FROM plugin ORDER BY plugin_id DESC LIMIT 9";
    $rows = $pdo->query($getPlugins);

    $plugins = "";
    $i = 1;
    foreach ( $rows as $plugin) {
        $plugins .= '
            <div class="portfolioImg folioImgFix_'.$i.'">
                <img src="'.$plugin['plugin_picture'].'" alt="">
                <div class="folioHover">
                    <a class="prePhoto" href="'.$plugin['plugin_link'].'"><i class="fa fa-download"></i></a>
                    <a onclick="redirectPlugin('.$plugin['plugin_id'].')" class="detailsLink"><i class="fa fa-info"></i></a>
                    <form id="'.$plugin['plugin_id'].'" method="post" action="plugin">
                        <input type="hidden" name="plugin_id" value="'.$plugin['plugin_id'].'">
                    </form>
                </div>
            </div>
        ';

        if ( $i == 4 || $i == 7 || $i == 9 ) {
            $plugins .= '<div class="clearfix"></div>';
        }
        $i++;
    }
?>

<script>
    function redirectPlugin(id) {
        var form = $('#'+id);
        form.submit();
    }
</script>

<section class="sliderArea" data-currentslide="activRev_1">
    <div class="tp-banner1">
        <ul>
            <?= $slides ?>
        </ul>
    </div>
</section>

<section class="featureArea commonSection">
    <div class="container">
        <div class="row">
            <?= $features ?>
        </div>
    </div>
</section>

<section class="skillArea commonSection">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <h2 class="commonTittle white wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">Nos<span>compétences</span></h2>
                <p class="subTittle wow fadeInUp" data-wow-duration="700ms" data-wow-delay="350ms">
                    Ayant déjà quelques années d'expérience dans le développement Java,
                    voici une approximation des compétences de l'équipe dans le développement de plugins Minecraft.
                </p>
            </div>
        </div>
        <div class="row">
            <?= $skills ?>
        </div>
    </div>
</section>

<section class="portfolioArea home commonSection">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <h2 class="commonTittle folio wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">Nos<span>derniers plugins</span></h2>
                <p class="folioSubTittle wow fadeInUp" data-wow-duration="700ms" data-wow-delay="350ms">Mise à jour le 19/11/2017</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="singlePortfolio">
                    <?= $plugins ?>
                </div>
                <div class="mixurBtn">
                    <div class="viewBtn">
                        <a href="plugins">Voir plus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="funFactArea commonSection">
    <div class="allFacts">
        <div class="singleFacts text-center wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">
            <h1 class="mycounter" data-counter="15">15</h1>
            <p>Clients satisfaits</p>
        </div>
        <div class="singleFacts text-center wow fadeInUp" data-wow-duration="700ms" data-wow-delay="350ms">
            <h1 class="mycounter" data-counter="33">33</h1>
            <p>Plugins créés</p>
        </div>
        <div class="singleFacts text-center wow fadeInUp" data-wow-duration="700ms" data-wow-delay="400ms">
            <h1 class="mycounter" data-counter="1249">1249</h1>
            <p>Téléchargements</p>
        </div>
        <div class="singleFacts text-center wow fadeInUp" data-wow-duration="700ms" data-wow-delay="450ms">
            <h1 class="mycounter" data-counter="145">145</h1>
            <p>Visiteurs</p>
        </div>
    </div>
</section>
