<header class="headerArea">
    <div class="logo pull-left">
        <div class="logoImg">
            <a href="<?php echo WEBROOT ?>accueil"><img src="images/logo.svg" alt=""></a>
        </div>
        <h2><a href="<?php echo WEBROOT ?>accueil">Plugin<span>Maker</span></a></h2>
    </div>
    <nav class="mainMenu pull-left">
        <div class="menuButton hidden-lg hidden-md">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <ul>
            <li <?php if ( $page == 'home' ) echo 'class="active"'; ?>><a href="<?php echo WEBROOT ?>accueil"><i style="transform: translateY(-10%)" class="fa fa-home fa-lg" aria-hidden="true"></i> Accueil</a></li>
            <li <?php if ( $page == 'plugins' ) echo 'class="active"'; ?>><a href="<?php echo WEBROOT ?>plugins"><i style="transform: translateY(-10%)" class="fa fa-cubes fa-lg" aria-hidden="true"></i> Plugins</a></li>
            <li <?php if ( $page == 'news' ) echo 'class="active"'; ?>><a href="<?php echo WEBROOT ?>news"><i style="transform: translateY(-10%)" class="fa fa-newspaper-o fa-lg" aria-hidden="true"></i> Nouveautés</a></li>
            <li <?php if ( $page == 'equipe' ) echo 'class="active"'; ?>><a href="<?php echo WEBROOT ?>equipe"><i style="transform: translateY(-10%)" class="fa fa-users fa-lg" aria-hidden="true"></i> L'équipe</a></li>
            <?php if ( isset($_SESSION['Auth']['id'])) {?>
                <li <?php if ( $page == 'commande' && isset($_SESSION['Auth']['id']) ) echo 'class="active"'; ?>><a href="<?php echo WEBROOT ?>commande"><i style="transform: translateY(-10%)" class="fa fa-shopping-cart" aria-hidden="true"></i> Commande</a></li>
                <li <?php if ( $page == 'profil' && isset($_SESSION['Auth']['id']) ) echo 'class="active"'; ?>><a href="<?php echo WEBROOT ?>profil"><i style="transform: translateY(-10%)" class="fa fa-user" aria-hidden="true"></i> Profil </a></li>
                <li <?php if ( $page == 'signout' && isset($_SESSION['Auth']['id']) ) echo 'class="active"'; ?>><a href="<?php echo WEBROOT ?>signout"><i style="transform: translateY(-10%)" class="fa fa-times" aria-hidden="true"></i> Déconnexion </a></li>
            <?php } ?>
            <?php if ( !isset($_SESSION['Auth']['id'])) {?>
                <li <?php if ( $page == 'login' && !isset($_SESSION['Auth']['id']) ) echo 'class="active"'; ?>><a href="<?php echo WEBROOT ?>login"><i style="transform: translateY(-10%)" class="fa fa-sign-in" aria-hidden="true"></i> Connexion </a></li>
                <li <?php if ( $page == 'signin' && !isset($_SESSION['Auth']['id']) ) echo 'class="active"'; ?>><a href="<?php echo WEBROOT ?>signin"><i style="transform: translateY(-10%)" class="fa fa-user-plus" aria-hidden="true"></i> Inscription </a></li>
            <?php } ?>
        </ul>
    </nav>
    <div class="topSocial pull-right">
        <ul>
            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a class="twitter" href="mailto:contact@pluginmaker.fr"><i class="fa fa-envelope"></i></a></li>
            <li><a class="google" href="skype:maxence.picot.97@gmail.com?userinfo"><i class="fa fa-skype"></i></a></li>
        </ul>
    </div>
    <div class="clearfix"></div>
</header>