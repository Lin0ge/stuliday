<?php
    $page='index';
    require ('inc/connect.php');
    require ('inc/functions.php');


require('assets/head.php');
include('assets/nav.php'); 


    
    if(isset($_POST['submit_annonce'])){
       
        
        $title = htmlspecialchars($_POST['title']);
        $description = htmlspecialchars($_POST['description']);
        $category = htmlspecialchars($_POST['category']);
        $file= $_FILES['img_url'];
        $address = htmlspecialchars($_POST['address']);
        $price = htmlspecialchars($_POST['price']);
        $city = htmlspecialchars($_POST['city']);
        $user_id = $_SESSION['id'];
        $start_date =$_POST['start_date'];
        $end_date = $_POST['end_date'];
        
        if($file['size'] <= 1000000){
            $valid_ext=array('jpg','png','gif','jpeg');
            $check_ext = strtolower(substr(strrchr($file['name'], '.'),1));

            if(in_array($check_ext, $valid_ext)){

                $imgname     = uniqid() . '_' . $file['name'];
                $upload_dir  = "./assets/uploads/";
                $upload_name = $upload_dir . $imgname;
                $move_result = move_uploaded_file($file['tmp_name'], $upload_name);
    
                if($move_result){
    
    
                    $sth = $db->prepare(" INSERT INTO annonces(title,description,city,category,image_url,address_article,price,author_article,start_date,end_date) VALUES (:title,:description,:city,:category,:image_url,:address_article,:price,:author_article,:start_date,:end_date)
                    ");
                
                    $sth->bindValue(':title',$title);
                    $sth->bindValue(':description',$description);
                    $sth->bindValue(':city',$city);
                    $sth->bindValue(':category',$category);
                    $sth->bindValue(':image_url',$imgname);
                    $sth->bindValue(':address_article',$address);
                    $sth->bindValue(':price',$price);
                    $sth->bindValue(':author_article',$user_id);
                    $sth->bindValue(':start_date',$start_date);
                    $sth->bindValue(':end_date',$end_date);
                    
                    $sth->execute();
                    header("Location:profile.php");
                }

            }
    
        }else {echo "Photo Trop lourde";
            header("Location:create-annonce.php");
        }

    }
?>












    
    

    <!-- //         else: 
    //             echo '<a class=alert alert-danger>Error in uploading the file</a>';
    //             echo '<a class="btn btn-danger col" href="signup.php">Retour à la page d\'inscription</a>';
    //             die();
    //         endif;
    //     else: 
    //         echo 'the size of the file is not suitable';
    //         echo '<a class="btn btn-danger col" href="signup.php">Retour à la page d\'inscription</a>';
    //         die();
    //     endif;
    //     echo '<div class="alert alert-info"> Vous avez bien été ajouté à la base de données</div>';
    //     echo '<a class="btn btn-success col" href="index.php">Retour à la page d\'accueil</a>';

    // }else{
    //     echo 'Un problème est survenu !';
    //     echo '<a class="btn btn-danger col" href="signup.php">Retour à la page d\'inscription</a>';
    // } -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
















<?php require('assets/footer.php'); ?>