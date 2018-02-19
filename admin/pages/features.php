<?php
    $getFeatures = "SELECT * FROM feature";
    $rows = $pdo->query($getFeatures);

    $type = "feature";
    $features = "";
    foreach ( $rows as $feature) {
        $features .= '
                <tr id="'.$feature['feature_id'].'">
                    <td>'.$feature['feature_id'].'</td>
                    <td><img style="width: 100px;" src="../'.$feature['feature_picture'].'"/></td>
                    <td>'.$feature['feature_title'].'</td>
                    <td>'.$feature['feature_description'].'</td>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <form method="post" action="editFeature">
                                        <input type="hidden" value="'.$feature['feature_id'].'" name="id">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-pencil fa-fw"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <button type="button" onclick="removeElement('.$feature['feature_id'].',\''.$type.'\')" class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i></button>
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
                <h1 class="page-header">Fonctionnalités</h1>

                <a href="addFeature">
                    <button style="float: right;" type="button" class="btn btn-success"><i class="fa fa-plus fa-fw"></i> Ajouter une fonctionnalité</button>
                </a>

                <table class="table table-striped table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?= $features ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>