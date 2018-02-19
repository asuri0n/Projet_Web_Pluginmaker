<?php
    $getNews = "SELECT * FROM new";
    $rows = $pdo->query($getNews);

    $news = "";
    foreach ( $rows as $new) {
        $news .= '<option value="'.$new['new_id'].'">'.$new['new_title'].'</option>';
    }

    if ( isset($_FILES['picture']) && isset($_POST['title1']) && isset($_POST['title2']) && isset($_POST['new_id']) && isset($_POST['description'])) {
        $uploaddir = '../images/uploads/';
        $uploadfile = $uploaddir . basename($_FILES['picture']['name']);
        move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile);

        $sql = "INSERT INTO slide (slide_title1,slide_title2,slide_description,slide_picture,new_id) VALUES (:title1,:title2,:description,:picture,:new)";
        $pdo->query($sql,array("title"=>$_POST['title'],"description"=>$_POST['description'],"picture"=>"images/uploads/".$_FILES['picture']['name'],"new"=>$_POST['new_id']));

        header('Location: slides');
    }
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ajouter une slide</h1>

                <a href="slides">
                    <button type="submit" class="btn btn-default"><i class="fa fa-backward" aria-hidden="true"></i> Retour</button>
                </a>

                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Titre 1</label>
                        <input class="form-control" name="title1">
                    </div>
                    <div class="form-group">
                        <label>Titre 2</label>
                        <input class="form-control" name="title2">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="picture">
                    </div>
                    <div class="form-group">
                        <label>Nouveauté</label>
                        <select class="form-control" name="new_id">
                            <?= $news ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Ajouter</button>
                    <button type="reset" class="btn btn-info">Réinitialiser</button>
                </form>
            </div>
        </div>
    </div>
</div>