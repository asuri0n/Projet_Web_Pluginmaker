<?php
    include '../includes/functions.php';
    include '../includes/configuration.php';
    sec_session_start();

    if ( isset($_REQUEST['budget-min']) &&
         isset($_REQUEST['budget-max']) &&
         isset($_REQUEST['date-min']) &&
         isset($_REQUEST['date-max']) &&
         isset($_REQUEST['plugin']) &&
         isset($_REQUEST['version']) &&
         isset($_REQUEST['description'])) {

        $sql = "INSERT INTO orders (orders_number,orders_budgetmin,orders_budgetmax,orders_datemin,orders_datemax,orders_pluginname,orders_plugindesc,orders_pluginversion, u_id) 
                VALUES (:number,:budgetmin,:budgetmax,:datemin,:datemax,:pluginname,:plugindesc,:pluginversion,:userid)";
        $pdo->query($sql,array(
            "number"=>generateNumber(),
            "budgetmin"=>$_REQUEST['budget-min'],
            "budgetmax"=>$_REQUEST['budget-max'],
            "datemax"=>$_REQUEST['date-max'],
            "datemin"=>$_REQUEST['date-min'],
            "pluginname"=>$_REQUEST['plugin'],
            "plugindesc"=>$_REQUEST['description'],
            "pluginversion"=>$_REQUEST['version'],
            "userid"=>$_SESSION['Auth']['id']
        ));
    }

    function generateNumber() {
        return "MN-".uniqid();
    }