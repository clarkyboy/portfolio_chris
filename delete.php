<?php
    include_once 'functions/functions.php';
    if($_SESSION['logstat']!="Active" and $_SESSION['user_type'] != "Admin"){header("Location:index.php");}
    $id = $_GET['id'];
    $reg_status = "I";
    delete($id, $reg_status);
?>