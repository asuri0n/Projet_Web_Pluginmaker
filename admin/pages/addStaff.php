<?php
    if ( isset($_FILES['picture']) && isset($_POST['name']) && isset($_POST['statut']) && isset($_POST['description']) && isset($_POST['diplome']) && isset($_POST['experience']) && isset($_POST['skype'])) {
        $uploaddir = '../images/uploads/';
        $uploadfile = $uploaddir . basename($_FILES['picture']['name']);
        move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile);

        $sql = "INSERT INTO staff (staff_name,staff_description,staff_statut,staff_experience,staff_diplome,staff_skype,staff_picture) VALUES (:name,:description,:statut,:experience,:diplome,:skype,:picture)";
        $pdo->query($sql,array("name"=>$_POST['name'],"description"=>$_POST['description'],"statut"=>$_POST['statut'],"experience"=>$_POST['experience'],"diplome"=>$_POST['diplome'],"skype"=>$_POST['skype'],"picture"=>"images/uploads/".$_FILES['picture']['name']));

        header('Location: staff');
    }
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ajouter un membre</h1>

                <a href="staff">
                    <button type="submit" class="btn btn-default"><i class="fa fa-backward" aria-hidden="true"></i> Retour</button>
                </a>

                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nom</label>
                        <input class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Statut</label>
                        <input class="form-control" name="statut">
                    </div>
                    <div class="form-group">
                        <label>Experience</label>
                        <input class="form-control" name="experience">
                    </div>
                    <div class="form-group">
                        <label>Diplôme</label>
                        <input class="form-control" name="diplome">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="picture">
                    </div>
                    <div class="form-group">
                        <label>Skype</label>
                        <input class="form-control" name="skype">
                    </div>

                    <button type="submit" class="btn btn-success">Ajouter</button>
                    <button type="reset" class="btn btn-info">Réinitialiser</button>
                </form>
            </div>
        </div>
    </div>
</div>