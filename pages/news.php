<?php
    $page = "news";
    $title = "Les nouveautés.";

    $getNews = "SELECT * FROM new ORDER BY new_date DESC";
    $rows = $pdo->query($getNews);

    $news = "";
    foreach ( $rows as $new) {
        $day = date("d",strtotime($new['new_date']));
        $year = date("Y",strtotime($new['new_date']));
        $month = str_replace(
            array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
            array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'),
            date("F",strtotime($new['new_date']))
        );

        $news .= '
            <div class="col-lg-6 col-sm-6 col-xs-12 text-center wow zoomIn" data-wow-duration="700ms" data-wow-delay="300ms">
                <div class="blogCotent">
                    <div class="postThumb">
                        <img src="'.$new['new_picture'].'" alt="">
                        <div class="postDate">
                            <h1>'.$day.'</h1>
                            <h2>'.$month.'</h2>
                            <p>'.$year.'</p>
                        </div>
                    </div>
                    <div class="postContent two">
                        <h3><a href="#">'.$new['new_title'].'</a></h3>
                        <p>'.$new['new_description'].'</p>
                        <div class="postMeta">
                            <div class="metaLeft pull-left">
                                <i class="icon-user3"></i>
                                <span>par</span>
                                <a href="equipe">'.$new['new_author'].'</a>
                            </div>
                            <div class="metaRight pull-right">
                                <p><i class="icon-heart4"></i></p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
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
                <h1 class="wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">Les <span>nouveautés</span></h1>
                <ul class="breadLink wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">
                    <li><a href="accueil">Accueil</a><span>|</span></li>
                    <li>Nouveautés</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="blogGridArea commonSection">
    <div class="container">
        <div class="row">
            <?= $news ?>
        </div>
    </div>
</section>