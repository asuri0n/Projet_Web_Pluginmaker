<?php
    $getNews = "SELECT * FROM new";
    $rows = $pdo->query($getNews);

    $type = "new";
    $news = "";
    foreach ( $rows as $new) {
        $news .= '
            <tr id="'.$new['new_id'].'">
                <td>'.$new['new_id'].'</td>
                <td>'.$new['new_title'].'</td>
                <td>'.$new['new_date'].'</td>
                <td>'.$new['new_author'].'</td>
                <td>'.$new['new_description'].'</td>
                <td>'.$new['new_texte'].'</td>
                <td><img style="width: 100px;" src="../'.$new['new_picture'].'"/></td>
                <td>
                    <table>
                            <tr>
                                <td>
                                    <form method="post" action="editNew">
                                        <input type="hidden" value="'.$new['new_id'].'" name="id">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-pencil fa-fw"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <button type="button" onclick="removeElement('.$new['new_id'].',\''.$type.'\')" class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i></button>
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
                <h1 class="page-header">Nouveautés</h1>

                <a href="addNew">
                    <button style="float: right;" type="button" class="btn btn-success"><i class="fa fa-plus fa-fw"></i> Ajouter une nouveauté</button>
                </a>

                <table class="table table-striped table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Date</th>
                        <th>Auteur</th>
                        <th>Description</th>
                        <th>Texte</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?= $news ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>