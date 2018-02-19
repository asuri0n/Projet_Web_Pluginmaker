<?php
    $getCategories = "SELECT * FROM categorie";
    $rows = $pdo->query($getCategories);

    $type = "categorie";
    $categories = "";
    foreach ( $rows as $categorie) {
        $categories .= '
            <tr id="'.$categorie['categorie_id'].'">
                <td>'.$categorie['categorie_id'].'</td>
                <td>'.$categorie['categorie_name'].'</td>
                <td>'.$categorie['categorie_title'].'</td>
                <td>
                    <table>
                        <tr>
                            <td>
                                <form method="post" action="editCategorie">
                                    <input type="hidden" value="'.$categorie['categorie_id'].'" name="id">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-pencil fa-fw"></i></button>
                                </form>
                            </td>
                            <td>
                                <button type="submit" onclick="removeElement('.$categorie['categorie_id'].',\''.$type.'\')" class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i></button>
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
                <h1 class="page-header">Catégories</h1>

                <a href="addCategorie">
                    <button style="float: right;" type="button" class="btn btn-success"><i class="fa fa-plus fa-fw"></i> Ajouter une catégorie</button>
                </a>

                <table class="table table-striped table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Titre</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?= $categories ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>