<?php
    if ( isset($_POST['name']) && isset($_POST['title'])) {
        if ( $_POST['name'] != "" && $_POST['title'] != "" ) {
            echo "TEST";

            $sql = "INSERT INTO categorie (categorie_name,categorie_title) VALUES (:name,:title)";
            $pdo->query($sql,array("name"=>$_POST['name'],"title"=>$_POST['title']));

            header('Location: categories');
        }
    }

?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ajouter une catégorie</h1>

                <a href="categories">
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

                    <button type="submit" class="btn btn-success">Ajouter</button>
                    <button type="reset" class="btn btn-info">Réinitialiser</button>
                </form>
            </div>
        </div>
    </div>
</div>