<?php
    if ( !isset($_POST['id'])) { header("Location: categories"); }

    $sql = "SELECT * FROM categorie WHERE categorie_id=:id";
    $row = $pdo->row($sql,array("id"=>$_POST['id']));

    if ( isset($_POST['edit'])) {
        $sql = "UPDATE categorie SET categorie_name=:name, categorie_title=:title WHERE categorie_id=:id";
        $pdo->query($sql,array("id"=>$_POST['id'],"name"=>$_POST['name'],"title"=>$_POST['title']));

        header("Location: categories");
    }
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Editer une catégorie</h1>

                <a href="categories">
                    <button type="submit" class="btn btn-default"><i class="fa fa-backward" aria-hidden="true"></i> Retour</button>
                </a>

                <form method="post">
                    <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
                    <div class="form-group">
                        <label>Nom</label>
                        <input class="form-control" name="name" value="<?= $row['categorie_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Titre</label>
                        <input class="form-control" name="title" value="<?= $row['categorie_title'] ?>">
                    </div>

                    <button type="submit" name="edit" class="btn btn-info">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>
