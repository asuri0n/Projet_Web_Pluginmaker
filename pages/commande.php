<?php
    if ( !isset($_SESSION['Auth']['id'])) { header("Location: accueil"); }

    $page = "commande";
    $title = "Commandez un plugin.";
?>

<section class="breadCrumArea">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <h1 class="wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">Commandez un <span>plugin</span></h1>
                <ul class="breadLink wow fadeInUp" data-wow-duration="700ms" data-wow-delay="350ms">
                    <li><a href="accueil">Accueil</a><span>|</span></li>
                    <li>Commande</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section -->
<section class="contactArea commonSection">
    <div class="container">
        <div class="row">
            <div class="md-stepper-horizontal orange">
                <div class="md-step" id="1step" onclick="change(1)">
                    <div class="md-step-circle"><span>1</span></div>
                    <div class="md-step-title">Informations</div>
                    <div class="md-step-bar-left"></div>
                    <div class="md-step-bar-right"></div>
                </div>
                <div class="md-step" id="2step" onclick="change(2)">
                    <div class="md-step-circle"><span>2</span></div>
                    <div class="md-step-title">Description</div>
                    <div class="md-step-bar-left"></div>
                    <div class="md-step-bar-right"></div>
                </div>
                <div class="md-step" id="3step" onclick="change(3)">
                    <div class="md-step-circle"><span>3</span></div>
                    <div class="md-step-title">Budget</div>
                    <div class="md-step-bar-left"></div>
                    <div class="md-step-bar-right"></div>
                </div>
                <div class="md-step" id="4step" onclick="change(4)">
                    <div class="md-step-circle"><span>4</span></div>
                    <div class="md-step-title">Délais</div>
                    <div class="md-step-bar-left"></div>
                    <div class="md-step-bar-right"></div>
                </div>
            </div>

            <div id="step1">
                <div class="col-lg-8 col-lg-offset-2 col-sm-12 col-xs-12 text-center animated fadeIn">

                    <p class="description">
                        Saisissez les informations vous concernant pour que l'équipe de PluginsMaker puisse vous contacter
                        plus facilement.
                    </p>

                    <div class="contactForm">
                        <form id="form-contact">
                            <input style="width: 100%; margin-bottom: 10px" class="required" type="text" placeholder="Nom *" id="nom">
                            <input style="width: 100%; margin-bottom: 10px" class="required" type="text" placeholder="Prénom *" id="prenom">
                            <input style="width: 100%; margin-bottom: 10px" class="required" type="text" placeholder="Pseudo Minecraft *" id="pseudo">
                            <input style="width: 100%; margin-bottom: 10px" class="required" type="text" placeholder="Skype (facultatif)" id="skype">
                            <input style="width: 100%" class="required" type="email" placeholder="Adresse email *" id="email">
                            <button type="button" onclick="checkStep(1)">Suivant</button>
                        </form>
                    </div>
                </div>
            </div>

            <div id="step2">
                <div class="col-lg-8 col-lg-offset-2 col-sm-12 col-xs-12 text-center animated fadeIn">

                    <p class="description">
                        Décrivez le plus précisement possible votre idée de plugin. Ces informations vont nous permettre
                        d'éstimer au mieux le temps de développement et le prix.
                    </p>

                    <div class="contactForm">
                        <form id="form-contact">
                            <input style="width: 100%; margin-bottom: 10px" class="required" type="text" placeholder="Nom du plugin *" id="name">
                            <input style="width: 100%" class="required" type="text" placeholder="Version du plugin *" id="version">
                            <textarea class="required" placeholder="Description du plugin *" id="description"></textarea>
                            <input style="width: 100%" class="required" type="file" placeholder="Version du plugin *" id="version">
                            <button type="button" onclick="change(1);">Retour</button>
                            <button type="button" onclick="checkStep(2)">Suivant</button>
                        </form>
                    </div>
                </div>
            </div>

            <div id="step3">
                <div class="col-lg-8 col-lg-offset-2 col-sm-12 col-xs-12 text-center animated fadeIn">

                    <p class="description">
                        Votre budget va nous permettre de voir quelles fonctionnalités nous pouvons implémenter parmi celle
                        que vous nous avez décrite. Bien évidemment, nous nous adaptons au budget de chacun dans la limite du
                        raisonnable.
                    </p>

                    <div class="contactForm">
                        <form id="form-contact">
                            <input style="width: 100%; margin-bottom: 10px" class="required" type="number" placeholder="Budget minimum *" id="min">
                            <input style="width: 100%; margin-bottom: 10px" class="required" type="number" placeholder="Budget maximum *" id="max">
                            <button type="button" onclick="change(2);">Retour</button>
                            <button type="button" onclick="checkStep(3)">Suivant</button>
                        </form>
                    </div>
                </div>
            </div>

            <div id="step4">
                <div class="col-lg-8 col-lg-offset-2 col-sm-12 col-xs-12 text-center animated fadeIn">

                    <p class="description">
                        Ces dates vont nous permettre de savoir quand nous allons commencer le développement et quand nous
                        allons terminer le développement.
                    </p>

                    <div class="contactForm">
                        <form id="form-contact">
                            <input style="width: 100%; margin-bottom: 10px" class="required" type="date" placeholder="Date minimum *" id="dateMin">
                            <input style="width: 100%; margin-bottom: 10px" class="required" type="date" placeholder="Date maximum *" id="dateMax">
                            <button type="button" onclick="change(3);">Retour</button>
                            <button type="button" onclick="checkStep(4)">Terminer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
