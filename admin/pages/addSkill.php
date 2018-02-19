<?php
    if ( isset($_POST['name']) && isset($_POST['title']) && isset($_POST['pourcent'])) {
        if ( $_POST['name'] != "" && $_POST['title'] != "" && $_POST['pourcent'] != "" ) {
            echo "TEST";

            $sql = "INSERT INTO skill (skill_name,skill_title,skill_pourcent) VALUES (:name,:title,:pourcent)";
            $pdo->query($sql,array("name"=>$_POST['name'],"title"=>$_POST['title'],"pourcent"=>$_POST['pourcent']));

            header('Location: skills');
        }
    }

?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ajouter une compétence</h1>

                <a href="skills">
                    <button type="submit" class="btn btn-default"><i class="fa fa-backward" aria-hidden="true"></i> Retour</button>
                </a>

                <form method="post">
                    <div class="form-group">
                        <label>Nom</label>
                        <input class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label>Titre</label>
                        <input class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <label>Pourcentage</label>
                        <input type="number" step="0.01" class="form-control" name="pourcent">
                    </div>

                    <button type="submit" class="btn btn-success">Ajouter</button>
                    <button type="reset" class="btn btn-info">Réinitialiser</button>
                </form>
            </div>
        </div>
    </div>
</div>
