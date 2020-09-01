<?php
    require('inc/connect.php');
    require('inc/functions.php'); 
    if (isset($_GET['id']))
    {
        $id = $_GET['id'];

        $sth = $db->prepare("DELETE FROM annonces WHERE id = $id");
        $sth->execute();

        

        header("Location:profile.php");

    }
        
        