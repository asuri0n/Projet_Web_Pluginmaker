<?php
    $page = "equipe";
    $title = "L'équipe PluginMaker.";

    $getStaff = "SELECT * FROM staff";
    $rows = $pdo->query($getStaff);

    $staffs = "";
    $slides = "";
    $i = 0;
    foreach ( $rows as $staff) {
        $active = "";
        if ( $i == 0 ) { $active = 'active'; }

        $slides .= '<li data-target="#teamCarousel" data-slide-to="'.$i.'" class="'.$active.'"></li>';
        $staffs .= '
            <div class="item '.$active.'">
                <div class="memberImg">
                    <img src="'.$staff['staff_picture'].'" alt="">
                </div>
                <div class="memberDetails">
                    <h3>'.$staff['staff_name'].'</h3>
                    <p>'.$staff['staff_description'].'</p>
                    <ul class="memberMeta">
                        <li><i class="fa fa-star" aria-hidden="true"></i><span>Statut :</span>'.$staff['staff_statut'].'</li>
                        <li><i class="fa fa-certificate" aria-hidden="true"></i><span>Experience :</span>'.$staff['staff_experience'].'</li>
                        <li><i class="fa fa-graduation-cap" aria-hidden="true"></i><span>Diplôme :</span>'.$staff['staff_diplome'].'</li>
                    </ul>
                    <div class="topSocial text-center">
                        <ul>
                            <li><a href="skype:'.$staff['staff_skype'].'?userinfo" class="google"><i class="fa fa-skype"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        ';
        $i++;
    }
?>

<section class="breadCrumArea">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <h1 class="wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">L'équipe <span>PluginMaker</span></h1>
                <ul class="breadLink wow fadeInUp" data-wow-duration="700ms" data-wow-delay="350ms">
                    <li><a href="accueil">Accueil</a><span>|</span></li>
                    <li>L'équipe</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Member Section -->
<section class="colleagueArea commonSection">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div id="teamCarousel" class="carousel slide wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?= $slides ?>
                    </ol>

                    <div class="carousel-inner" role="listbox" style="background-color: white">
                        <?= $staffs ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
