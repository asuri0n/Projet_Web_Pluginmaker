<?php
    $getOrders = "SELECT * FROM orders JOIN user USING(u_id)";
    $rows = $pdo->query($getOrders);

    $type = "orders";
    $orders = "";
    foreach ( $rows as $order) {
        $orders .= '
                <tr id="'.$order['orders_id'].'">
                    <td>'.$order['orders_id'].'</td>
                    <td>'.$order['orders_number'].'</td>
                    <td>'.$order['orders_pluginname'].'</td>
                    <td>'.$order['orders_pluginversion'].'</td>
                    <td>'.$order['orders_plugindesc'].'</td>
                    <td>'.$order['orders_budgetmin'].'€ - '.$order['orders_budgetmax'].'€</td>
                    <td>'.date_format(date_create($order['orders_datemin']),"d/m/Y").' - '.date_format(date_create($order['orders_datemax']),"d/m/Y").'</td>
                    <td>'.$order['u_identifiant'].'</td>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <form method="post">
                                        <input type="hidden" value="'.$order['orders_id'].'" name="id">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-eye"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <button type="button" onclick="removeElement('.$order['orders_id'].',\''.$type.'\')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
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
                <h1 class="page-header">Commandes</h1>

                <table class="table table-striped table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Numéro</th>
                        <th>Nom du plugin</th>
                        <th>Version du plugin</th>
                        <th>Description</th>
                        <th>Budget</th>
                        <th>Deadline</th>
                        <th>Utilisateur</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?= $orders ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
