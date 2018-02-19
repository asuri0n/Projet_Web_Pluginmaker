<?php
    if ( !isset($_POST['id'])) { header("Location: skills"); }

    $sql = "SELECT * FROM skill WHERE skill_id=:id";
    $row = $pdo->row($sql,array("id"=>$_POST['id']));

    if ( isset($_POST['edit'])) {
        $sql = "UPDATE skill SET skill_name=:name, skill_title=:title, skill_pourcent=:pourcent WHERE skill_id=:id";
        $pdo->query($sql,array("id"=>$_POST['id'],"name"=>$_POST['name'],"title"=>$_POST['title'],"pourcent"=>$_POST['pourcent']));

        header("Location: skills");
    }
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Editer une compétence</h1>

                <a href="skills">
                    <button type="submit" class="btn btn-default"><i class="fa fa-backward" aria-hidden="true"></i> Retour</button>
                </a>

                <form method="post">
                    <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
                    <div class="form-group">
                        <label>Nom</label>
                        <input class="form-control" name="name" value="<?= $row['skill_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Titre</label>
                        <input class="form-control" name="title" value="<?= $row['skill_title'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Pourcentage</label>
                        <input class="form-control" name="pourcent" type="number" step="0.01" max="1" value="<?= $row['skill_pourcent'] ?>">
                    </div>

                    <button type="submit" name="edit" class="btn btn-info">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>