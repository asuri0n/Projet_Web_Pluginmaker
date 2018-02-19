<?php
    if ( !isset($_POST['id'])) { header("Location: plugins"); }

    $sql = "SELECT * FROM plugin WHERE plugin_id=:id";
    $row = $pdo->row($sql,array("id"=>$_POST['id']));

    $getCategories = "SELECT * FROM categorie";
    $rows = $pdo->query($getCategories);

    $categories = "";
    foreach ( $rows as $categorie) {
        if ( $categorie['categorie_id'] == $row['categorie_id'] ) {
            $categories .= '<option selected value="' . $categorie['categorie_id'] . '">' . $categorie['categorie_title'] . '</option>';
        } else {
            $categories .= '<option value="' . $categorie['categorie_id'] . '">' . $categorie['categorie_title'] . '</option>';
        }
    }

    if ( isset($_POST['edit'])) {
        if ( $_FILES['picture']['name'] != "" ) {
            $uploaddir = '../images/uploads/';
            $uploadfile = $uploaddir . basename($_FILES['picture']['name']);
            move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile);

            $sql = "UPDATE plugin SET plugin_title=:title, plugin_name=:name, plugin_link=:link, plugin_description=:description, plugin_price=:price, plugin_picture=:picture, categorie_id=:categorie WHERE plugin_id=:id";
            $pdo->query($sql,array("id"=>$_POST['id'],"title"=>$_POST['title'],"name"=>$_POST['name'],"link"=>$_POST['link'],"description"=>$_POST['description'],"price"=>$_POST['price'],"picture"=>"images/uploads/".$_FILES['picture']['name'],"categorie"=>$_POST['categorie_id']));
        } else {
            $sql = "UPDATE plugin SET plugin_title=:title, plugin_name=:name, plugin_link=:link, plugin_description=:description, plugin_price=:price, categorie_id=:categorie WHERE plugin_id=:id";
            $pdo->query($sql,array("id"=>$_POST['id'],"title"=>$_POST['title'],"name"=>$_POST['name'],"link"=>$_POST['link'],"description"=>$_POST['description'],"price"=>$_POST['price'],"categorie"=>$_POST['categorie_id']));
        }
        header("Location: plugins");
    }

?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Editer un plugin</h1>

                <a href="plugins">
                    <button type="submit" class="btn btn-default"><i class="fa fa-backward" aria-hidden="true"></i> Retour</button>
                </a>

                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
                    <div class="form-group">
                        <label>Nom</label>
                        <input class="form-control" name="name" value="<?= $row['plugin_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Titre</label>
                        <input class="form-control" name="title" value="<?= $row['plugin_title'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Lien</label>
                        <input class="form-control" name="link" value="<?= $row['plugin_link'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <br/><img width="10%" src="../<?= $row['plugin_picture'] ?>">
                        <input type="file" name="picture">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description"><?= $row['plugin_description'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Prix</label>
                        <input type="number" class="form-control" name="price" value="<?= $row['plugin_price'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Catégorie</label>
                        <select class="form-control" name="categorie_id">
                            <?= $categories ?>
                        </select>
                    </div>

                    <button type="submit" name="edit" class="btn btn-info">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>
