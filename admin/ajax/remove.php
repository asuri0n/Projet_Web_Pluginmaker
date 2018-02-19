<?php
    include '../../includes/configuration.php';

    if ( isset($_REQUEST['id']) && isset($_REQUEST['type']) ) {
        $id = $_REQUEST['id'];
        $type = $_REQUEST['type'];
        $sql = "DELETE FROM ".$type." WHERE ".$type."_id=:id";
        $pdo->query($sql,array("id"=>$id));
    }