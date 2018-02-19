<?php
    $page = "Signin";
    $title = "L'équipe PluginMaker.";

    if ( isset($_POST['inscription'])) {
        if ( isset($_POST['identifiant']) && isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['id_skype']) && isset($_POST['id_minecraft'])) {
            if (signup()) {
                echo "<script>toast('Inscription réussi', 'success', 'Ok', 5000)</script>";
            } else {
                echo "<script>toast('".$_SESSION['error']."', 'error', 'Erreur', 5000);</script>";
            }
        } else {
            echo "<script>toast(\"Veuillez saisir tout les champs requis.\", 'error', 'Erreur', 5000);</script>";
        }
    } else
?>
<section class="breadCrumArea">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <h1 class="wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">Connection</h1>
            </div>
        </div>
    </div>
</section>
<!-- Member Section -->
<section class="colleagueArea commonSection">
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="login-panel panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Inscription</h3>
                            </div>
                            <div class="panel-body">
                                <form method="post">
                                    <fieldset>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Identifiant" name="identifiant" type="text" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Prenom" name="prenom" type="text" value="">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Nom" name="nom" type="text" value="">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Email" name="email" type="email" value="">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Mot de passe" name="password" type="password" value="">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Confirmation mot de passe" name="password2" type="password" value="">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Compte Skype (optionnel)" name="id_skype" type="text" value="">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Compte Minecraft" name="id_minecraft" type="text" value="">
                                        </div>

                                        <button name="inscription" type="submit" class="btn btn-lg btn-success btn-block">Inscription</button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>