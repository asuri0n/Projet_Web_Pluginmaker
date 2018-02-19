<?php
    if ( !isset($_POST['id'])) { header("Location: staff"); }

    $sql = "SELECT * FROM staff WHERE staff_id=:id";
    $row = $pdo->row($sql,array("id"=>$_POST['id']));

    if ( isset($_POST['edit'])) {
        if ( $_FILES['picture']['name'] != "" ) {
            $uploaddir = '../images/uploads/';
            $uploadfile = $uploaddir . basename($_FILES['picture']['name']);
            move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile);

            $sql = "UPDATE staff SET staff_name=:name, staff_statut=:statut, staff_diplome=:diplome, staff_description=:description, staff_experience=:experience, staff_skype=:skype, staff_picture=:picture WHERE staff_id=:id";
            $pdo->query($sql,array("id"=>$_POST['id'],"name"=>$_POST['name'],"statut"=>$_POST['statut'],"skype"=>$_POST['skype'],"description"=>$_POST['description'],"diplome"=>$_POST['diplome'],"experience"=>$_POST['experience'],"picture"=>"images/uploads/".$_FILES['picture']['name']));
        } else {
            $sql = "UPDATE staff SET staff_name=:name, staff_statut=:statut, staff_diplome=:diplome, staff_description=:description, staff_experience=:experience, staff_skype=:skype WHERE staff_id=:id";
            $pdo->query($sql,array("id"=>$_POST['id'],"name"=>$_POST['name'],"statut"=>$_POST['statut'],"skype"=>$_POST['skype'],"description"=>$_POST['description'],"diplome"=>$_POST['diplome'],"experience"=>$_POST['experience']));
        }
        header("Location: staff");
    }
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Editer un membre</h1>

                <a href="staff">
                    <button type="submit" class="btn btn-default"><i class="fa fa-backward" aria-hidden="true"></i> Retour</button>
                </a>

                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
                    <div class="form-group">
                        <label>Nom</label>
                        <input class="form-control" name="name" value="<?= $row['staff_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Statut</label>
                        <input type="text" class="form-control" name="statut" value="<?= $row['staff_statut'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Experience</label>
                        <input class="form-control" name="experience" value="<?= $row['staff_experience'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description"><?= $row['staff_description'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Diplôme</label>
                        <input class="form-control" name="diplome" value="<?= $row['staff_diplome'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <br/><img width="10%" src="../<?= $row['staff_picture'] ?>">
                        <input type="file" name="picture">
                    </div>
                    <div class="form-group">
                        <label>Skype</label>
                        <input class="form-control" name="skype" value="<?= $row['staff_skype'] ?>">
                    </div>

                    <button type="submit" name="edit" class="btn btn-info">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>