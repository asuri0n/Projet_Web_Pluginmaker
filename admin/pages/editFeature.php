<?php
    if ( !isset($_POST['id'])) { header("Location: features"); }

    $sql = "SELECT * FROM feature WHERE feature_id=:id";
    $row = $pdo->row($sql,array("id"=>$_POST['id']));

    if ( isset($_POST['edit'])) {
        if ( $_FILES['picture']['name'] != "" ) {
            $uploaddir = '../images/uploads/';
            $uploadfile = $uploaddir . basename($_FILES['picture']['name']);
            move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile);

            $sql = "UPDATE feature SET feature_title=:title, feature_description=:description, new_picture=:picture WHERE feature_id=:id";
            $pdo->query($sql,array("id"=>$_POST['id'],"title"=>$_POST['title'],"description"=>$_POST['description'],"picture"=>"images/uploads/".$_FILES['picture']['name']));
        } else {
            $sql = "UPDATE feature SET feature_title=:title, feature_description=:description WHERE feature_id=:id";
            $pdo->query($sql,array("id"=>$_POST['id'],"title"=>$_POST['title'],"description"=>$_POST['description']));
        }
        header("Location: features");
    }
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Editer une nouveautés</h1>

                <a href="features">
                    <button type="submit" class="btn btn-default"><i class="fa fa-backward" aria-hidden="true"></i> Retour</button>
                </a>

                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
                    <div class="form-group">
                        <label>Titre</label>
                        <input class="form-control" name="title" value="<?= $row['feature_title'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description"><?= $row['feature_description'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <br/><img width="10%" src="../<?= $row['feature_picture'] ?>">
                        <input type="file" name="picture">
                    </div>

                    <button type="submit" name="edit" class="btn btn-info">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>