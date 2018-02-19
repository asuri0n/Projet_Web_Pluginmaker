<?php
    $getSkills = "SELECT * FROM skill";
    $rows = $pdo->query($getSkills);

    $type = "skill";
    $skills = "";
    foreach ( $rows as $skill) {
        $skills .= '
            <tr id="'.$skill['skill_id'].'">
                <td>'.$skill['skill_id'].'</td>
                <td>'.$skill['skill_pourcent'].'</td>
                <td>'.$skill['skill_name'].'</td>
                <td>'.$skill['skill_title'].'</td>
                <td>
                    <table>
                        <tr>
                            <td>
                                <form method="post" action="editSkill">
                                    <input type="hidden" value="'.$skill['skill_id'].'" name="id">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-pencil fa-fw"></i></button>
                                </form>
                            </td>
                            <td>
                                <button type="button" onclick="removeElement('.$skill['skill_id'].',\''.$type.'\')" class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i></button>
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
                <h1 class="page-header">Compétences</h1>

                <a href="addSkill">
                    <button style="float: right;" type="button" class="btn btn-success"><i class="fa fa-plus fa-fw"></i> Ajouter une compétence</button>
                </a>

                <table class="table table-striped table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Pourcentage</th>
                        <th>Nom</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?= $skills ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
