<?php
    if ( isset($_FILES['picture']) && isset($_POST['title']) && isset($_POST['description'])) {
        $uploaddir = '../images/uploads/';
        $uploadfile = $uploaddir . basename($_FILES['picture']['name']);
        move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile);

        $sql = "INSERT INTO feature (feature_title,feature_description,feature_picture) VALUES (:title,:description,:picture)";
        $pdo->query($sql,array("title"=>$_POST['title'],"description"=>$_POST['description'],"picture"=>"images/uploads/".$_FILES['picture']['name']));

        header('Location: features');
    }
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ajouter une fonctionnalité</h1>

                <a href="features">
                    <button type="submit" class="btn btn-default"><i class="fa fa-backward" aria-hidden="true"></i> Retour</button>
                </a>

                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Titre</label>
                        <input class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="picture">
                    </div>

                    <button type="submit" class="btn btn-success">Ajouter</button>
                    <button type="reset" class="btn btn-info">Réinitialiser</button>
                </form>
            </div>
        </div>
    </div>
</div>