<?php
    if ( !isset($_POST['id'])) { header("Location: slides"); }

    $sql = "SELECT * FROM slide WHERE slide_id=:id";
    $row = $pdo->row($sql,array("id"=>$_POST['id']));

    $getNews = "SELECT * FROM new";
    $rows = $pdo->query($getNews);

    $news = "";
    foreach ( $rows as $new) {
        if ( $new['new_id'] == $row['new_id'] ) {
            $news .= '<option selected value="' . $new['new_id'] . '">' . $new['new_title'] . '</option>';
        } else {
            $news .= '<option value="' . $new['new_id'] . '">' . $new['new_title'] . '</option>';
        }
    }

    if ( isset($_POST['edit'])) {
        if ( $_FILES['picture']['name'] != "" ) {
            $uploaddir = '../images/uploads/';
            $uploadfile = $uploaddir . basename($_FILES['picture']['name']);
            move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile);

            $sql = "UPDATE slide SET slide_title1=:title1, slide_title2=:title2, slide_description=:description, slide_picture=:picture, new_id=:new_id WHERE slide_id=:id";
            $pdo->query($sql,array("id"=>$_POST['id'],"title1"=>$_POST['title1'],"title2"=>$_POST['title2'],"description"=>$_POST['description'],"new_id"=>$_POST['new_id'],"picture"=>"images/uploads/".$_FILES['picture']['name']));
        } else {
            $sql = "UPDATE slide SET slide_title1=:title1, slide_title2=:title2, slide_description=:description, new_id=:new_id WHERE slide_id=:id";
            $pdo->query($sql,array("id"=>$_POST['id'],"title1"=>$_POST['title1'],"title2"=>$_POST['title2'],"description"=>$_POST['description'],"new_id"=>$_POST['new_id']));
        }
        header("Location: slides");
    }
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Editer une slide</h1>

                <a href="slides">
                    <button type="submit" class="btn btn-default"><i class="fa fa-backward" aria-hidden="true"></i> Retour</button>
                </a>

                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
                    <div class="form-group">
                        <label>Titre 1</label>
                        <input class="form-control" name="title1" value="<?= $row['slide_title1'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Titre 2</label>
                        <input class="form-control" name="title2" value="<?= $row['slide_title2'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description"><?= $row['slide_description'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <br/><img width="10%" src="../<?= $row['slide_picture'] ?>">
                        <input type="file" name="picture">
                    </div>
                    <div class="form-group">
                        <label>Nouveauté</label>
                        <select class="form-control" name="new_id">
                            <?= $news ?>
                        </select>
                    </div>

                    <button type="submit" name="edit" class="btn btn-info">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>