<?php
    require('inc/connect.php');
    require('inc/functions.php'); 
    if (isset($_GET['id']))
    {
        $id = $_SESSION['id'];

        $sth = $db->prepare("DELETE FROM users WHERE id = $id");
        $sth->execute();

        session_destroy();

        header("Location:login.php");

    }
        
        