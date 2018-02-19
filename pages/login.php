<?php
    $page = "Login";
    $title = "L'équipe PluginMaker.";

    if ( isset($_POST['connect'])) {
        if ( isset($_POST['password']) && isset($_POST['email']) ) {
            if (login($_POST['email'], $_POST['password'])) {
                echo "<script>toast('message', 'success', 'Ok', 5000)</script>";
                header("Location: profil");
            } else {
                echo "<script>toast('".$_SESSION['error']."', 'error', 'Erreur', 5000);</script>";
            }
        } else {
            echo "<script>toast(\"Veuillez saisir tout les champs requis.\", 'error', 'Erreur', 5000);</script>";
        }
    }
?>

<section class="breadCrumArea">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <h1 class="wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">Connexion</h1>
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
                                <h3 class="panel-title">Authentification</h3>
                            </div>
                            <div class="panel-body">
                                <form method="post">
                                    <fieldset>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Email" name="email" type="email" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Mot de passe" name="password" type="password" value="">
                                        </div>
                                        <button name="connect" type="submit" class="btn btn-lg btn-success btn-block">Connexion</button>
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

