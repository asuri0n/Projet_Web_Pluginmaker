<?php
    $getCategories = "SELECT * FROM categorie";
    $rows = $pdo->query($getCategories);

    $categories = "";
    foreach ( $rows as $categorie) {
        $categories .= '<option value="'.$categorie['categorie_id'].'">'.$categorie['categorie_title'].'</option>';
    }

    if ( isset($_FILES['picture']) && isset($_POST['title']) && isset($_POST['name']) && isset($_POST['link']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['categorie_id'])) {
        $uploaddir = '../images/uploads/';
        $uploadfile = $uploaddir . basename($_FILES['picture']['name']);
        move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile);

        $sql = "INSERT INTO plugin (plugin_name,plugin_title,plugin_link,plugin_picture,plugin_description,plugin_price,categorie_id) VALUES (:name,:title,:link,:picture,:description,:price,:categorie)";
        $pdo->query($sql,array("name"=>$_POST['name'],"title"=>$_POST['title'],"link"=>$_POST['link'],"picture"=>"images/uploads/".$_FILES['picture']['name'],"description"=>$_POST['description'],"price"=>$_POST['price'],"categorie"=>$_POST['categorie_id']));

        header('Location: plugins');
    }
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ajouter un plugin</h1>

                <a href="plugins">
                    <button type="submit" class="btn btn-default"><i class="fa fa-backward" aria-hidden="true"></i> Retour</button>
                </a>

                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nom</label>
                        <input class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label>Titre</label>
                        <input class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <label>Lien</label>
                        <input class="form-control" name="link">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="picture">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Prix</label>
                        <input type="number" class="form-control" name="price">
                    </div>
                    <div class="form-group">
                        <label>Catégorie</label>
                        <select class="form-control" name="categorie_id">
                            <?= $categories ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Ajouter</button>
                    <button type="reset" class="btn btn-default">Réinitialiser</button>
                </form>
            </div>
        </div>
    </div>
</div>