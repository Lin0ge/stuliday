<?php
    require('inc/connect.php');
    require('inc/functions.php'); 
    
    if(!empty($_POST['lastName']) && !empty($_POST['firstName'])){
        $id = $_SESSION['id'];
        $firstName = htmlspecialchars($_POST['firstName']);
        $lastName = htmlspecialchars($_POST['lastName']);
        $email = htmlspecialchars($_POST['email']);
        
            $sth = $db->prepare(" UPDATE users 
            SET firstName = :firstName,
            lastName= :lastName, 
            email= :email
            WHERE id=$id
            ");
    
            $sth->bindValue(':firstName',$firstName);
            $sth->bindValue(':lastName',$lastName);
            $sth->bindValue(':email',$email);
    
            $sth->execute();

            header("Location:profile.php");
            
    }else{
        echo 'Marche pas !';
        
    }
    
?>

