<?php
    $getStaff = "SELECT * FROM staff";
    $rows = $pdo->query($getStaff);

    $type = "staff";
    $staffs = "";
    foreach ( $rows as $staff) {
        $staffs .= '
                    <tr id="'.$staff['staff_id'].'">
                        <td>'.$staff['staff_id'].'</td>
                        <td>'.$staff['staff_name'].'</td>
                        <td>'.$staff['staff_description'].'</td>
                        <td>'.$staff['staff_statut'].'</td>
                        <td>'.$staff['staff_experience'].'</td>
                        <td>'.$staff['staff_diplome'].'</td>
                        <td><img style="width: 100px;" src="../'.$staff['staff_picture'].'"/></td>
                        <td>'.$staff['staff_skype'].'</td>
                        <td>
                            <table>
                                    <tr>
                                        <td>
                                            <form method="post" action="editStaff">
                                                <input type="hidden" value="'.$staff['staff_id'].'" name="id">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil fa-fw"></i></button>
                                            </form>
                                        </td>
                                        <td>
                                            <button type="button" onclick="removeElement('.$staff['staff_id'].',\''.$type.'\')" class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i></button>
                                        </td>
                                    </tr>
                            </table>
                        </td>
                    </tr>
                ';
    }
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Membres de l'équipe</h1>

                <a href="addStaff">
                    <button style="float: right;" type="button" class="btn btn-success"><i class="fa fa-plus fa-fw"></i> Ajouter un membre</button>
                </a>

                <table class="table table-striped table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Statut</th>
                        <th>Experience</th>
                        <th>Diplome</th>
                        <th>Image</th>
                        <th>Skype</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?= $staffs ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>