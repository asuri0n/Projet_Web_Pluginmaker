<?php
    if ( !isset($_POST['id'])) { header("Location: news"); }

    $sql = "SELECT * FROM new WHERE new_id=:id";
    $row = $pdo->row($sql,array("id"=>$_POST['id']));

    if ( isset($_POST['edit'])) {
        if ( $_FILES['picture']['name'] != "" ) {
            $uploaddir = '../images/uploads/';
            $uploadfile = $uploaddir . basename($_FILES['picture']['name']);
            move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile);

            $sql = "UPDATE new SET new_title=:title, new_date=:date, new_author=:author, new_description=:description, new_texte=:texte, new_picture=:picture WHERE new_id=:id";
            $pdo->query($sql,array("id"=>$_POST['id'],"title"=>$_POST['title'],"date"=>$_POST['date'],"author"=>$_POST['author'],"description"=>$_POST['description'],"texte"=>$_POST['texte'],"picture"=>"images/uploads/".$_FILES['picture']['name']));
        } else {
            $sql = "UPDATE new SET new_title=:title, new_date=:date, new_author=:author, new_description=:description, new_texte=:texte WHERE new_id=:id";
            $pdo->query($sql,array("id"=>$_POST['id'],"title"=>$_POST['title'],"date"=>$_POST['date'],"author"=>$_POST['author'],"description"=>$_POST['description'],"texte"=>$_POST['texte']));
        }
        header("Location: news");
    }
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Editer une nouveautés</h1>

                <a href="news">
                    <button type="submit" class="btn btn-default"><i class="fa fa-backward" aria-hidden="true"></i> Retour</button>
                </a>

                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
                    <div class="form-group">
                        <label>Titre</label>
                        <input class="form-control" name="title" value="<?= $row['new_title'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" value="<?= $row['new_date'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Auteur</label>
                        <input class="form-control" name="author" value="<?= $row['new_author'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description"><?= $row['new_description'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Texte</label>
                        <textarea class="form-control" name="texte"><?= $row['new_texte'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <br/><img width="10%" src="../<?= $row['new_picture'] ?>">
                        <input type="file" name="picture">
                    </div>

                    <button type="submit" name="edit" class="btn btn-info">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>
