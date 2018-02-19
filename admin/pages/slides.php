<?php
    $getSlides = "SELECT * FROM slide JOIN new USING(new_id)";
    $rows = $pdo->query($getSlides);

    $type = "slide";
    $slides = "";
    foreach ( $rows as $slide) {
        $slides .= '
                    <tr id="'.$slide['slide_id'].'">
                        <td>'.$slide['slide_id'].'</td>
                        <td>'.$slide['slide_title1'].'</td>
                        <td>'.$slide['slide_title2'].'</td>
                        <td><img style="width: 100px;" src="../'.$slide['slide_picture'].'"/></td>
                        <td>'.$slide['slide_description'].'</td>
                        <td>'.$slide['new_title'].'</td>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <form method="post" action="editSlide">
                                            <input type="hidden" value="'.$slide['slide_id'].'" name="id">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-pencil fa-fw"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <button type="button" onclick="removeElement('.$slide['slide_id'].',\''.$type.'\')" class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i></button>
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
                <h1 class="page-header">Slides</h1>

                <a href="addSlide">
                    <button style="float: right;" type="button" class="btn btn-success"><i class="fa fa-plus fa-fw"></i> Ajouter une slide</button>
                </a>

                <table class="table table-striped table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre 1</th>
                        <th>Titre 2</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Titre de la nouveauté</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?= $slides ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>