<?php
require_once 'header.php';
check_login();
if(isset($_REQUEST["id"])){
    $query = "delete from participant where sid = $_REQUEST[id] ";
    $r = run_sql($query);
    $whr ="";
    if(!is_admin()){
        $whr = " and email = '$_SESSION[email] '";
    }
    $query = "delete from survey where id = $_REQUEST[id] $whr ";
    $r = run_sql($query);
}
redirect("index.php");
?>
