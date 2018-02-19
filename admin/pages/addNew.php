<?php
    if ( isset($_FILES['picture']) && isset($_POST['title']) && isset($_POST['author']) && isset($_POST['description']) && isset($_POST['texte'])) {
        $uploaddir = '../images/uploads/';
        $uploadfile = $uploaddir . basename($_FILES['picture']['name']);
        move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile);

        $sql = "INSERT INTO new (new_title,new_date,new_author,new_description,new_texte,new_picture) VALUES (:title,NOW(),:author,:description,:texte,:picture)";
        $pdo->query($sql,array("title"=>$_POST['title'],"author"=>$_POST['author'],"description"=>$_POST['description'],"texte"=>$_POST['texte'],"picture"=>"images/uploads/".$_FILES['picture']['name']));

        header('Location: news');
    }
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ajouter une nouveautés</h1>

                <a href="news">
                    <button type="submit" class="btn btn-default"><i class="fa fa-backward" aria-hidden="true"></i> Retour</button>
                </a>

                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Titre</label>
                        <input class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <label>Auteur</label>
                        <input class="form-control" name="author">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Texte</label>
                        <textarea class="form-control" name="texte"></textarea>
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