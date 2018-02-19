<?php
    $getPlugins = "SELECT * FROM plugin JOIN categorie USING(categorie_id)";
    $rows = $pdo->query($getPlugins);

    $type = "plugin";
    $plugins = "";
    foreach ( $rows as $plugin) {
        $plugins .= '
            <tr id="'.$plugin['plugin_id'].'">
                <td>'.$plugin['plugin_id'].'</td>
                <td>'.$plugin['plugin_name'].'</td>
                <td>'.$plugin['plugin_title'].'</td>
                <td>'.$plugin['plugin_link'].'</td>
                <td><img style="width: 100px;" src="../'.$plugin['plugin_picture'].'"/></td>
                <td>'.$plugin['plugin_description'].'</td>
                <td>'.$plugin['plugin_price'].'</td>
                <td>'.$plugin['categorie_title'].'</td>
                <td>
                    <table>
                        <tr>
                            <td>
                                <form method="post" action="editPlugin">
                                    <input type="hidden" value="'.$plugin['plugin_id'].'" name="id">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-pencil fa-fw"></i></button>
                                </form>
                            </td>
                            <td>
                                <button type="button" onclick="removeElement('.$plugin['plugin_id'].',\''.$type.'\')" class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i></button>
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
                <h1 class="page-header">Plugins</h1>

                <a href="addPlugin">
                    <button style="float: right;" type="button" class="btn btn-success"><i class="fa fa-plus fa-fw"></i> Ajouter un plugin</button>
                </a>

                <table class="table table-striped table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Titre</th>
                        <th>Lien</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Catégorie</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?= $plugins ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>