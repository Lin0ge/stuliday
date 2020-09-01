<?php

   

    function random_image($h,$w){
        echo"https://loremflickr.com/$h/$w/cottage";
    }

    function shorten_text($text, $max = 120, $append = '&hellip;'){
        if(strlen($text)<=$max) return $text;
        $return = substr($text,0,$max);
        if (strpos($text,' ')===false) return $return . $append;
        return preg_replace('/\w+$/','',$return) .$append;
    }
    function displayAllUsers(){
        global $db;
        $sql = $db->query("SELECT * FROM users");
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $sql->fetch()){
            ?>
            <div class="col-4">
                <div class="card p-3">
                    <h2>User n°<?= $row ['id'];?></h2>
                    <p><?= $row['email'];?></p>
                </div>
            </div>
        <?php
        }

    }


    function displayAllAnnonces(){
        global $db;
        $id = $_SESSION['id'];
        $sql = $db->query("SELECT * FROM annonces WHERE author_article != $id AND active = 1" );
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $sql->fetch()){
            ?>
            <div class="col-4">
                <div class="card p-3 text-center">
                    <p>Type de bien : <?= $row['title'];?></p>
                    <p>Ville : <?= $row['city'];?></p>
                    <p>Prix : <?= $row['price'];?></p>
                    <img src="assets/uploads/<?= $row['image_url'];?>" alt="">
                    <a class="nav-link" href="annonces_single.php?id=<?= $row['id'] ?>">Voir l'annonce</a>
                    

                </div>
            </div>
        <?php
        }

    }

    function displayModalAnnonces($id){
        
        global $db;
        $id = $_SESSION['id'];
        $sql = $db->query("SELECT * FROM annonces WHERE author_article = $id");
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $sql->fetch()){
    
?>
        <div class="col-12">
                <div class="card p-3">
                <h2>Annonce n°<?= $row ['id'];?></h2>
                    <p>Type de bien : <?= $row['title'];?></p>
                    <p><?= $row['city'];?></p>
                    <p><?= $row['address_article'];?></p>
                    <p>Prix : <?= $row['price'];?></p>
                    <a class="nav-link" href="edit_annonce.php?id=<?= $row ['id']; ?>">Modifier</a>
                    <a class="nav-link" href="delete_annonce.php?id=<?= $row ['id']; ?>">Supprimer</a>
                    

                </div>
            </div>
        <?php
        }

    }



  
    function displayreza($id){
        global $db;
        $sql = $db-> query("SELECT * FROM annonces AS a LEFT JOIN reservations AS r ON r.id_annonce = a.id WHERE id_user = $id");
        $sql ->setFetchMode(PDO::FETCH_ASSOC);          
        while ($row = $sql->fetch()) {
?>
        <div class="container">
            <div class="text-center">
                <div class="card p-1 m-2">
                    <h2><?= $row['title']?> à <?= $row['city']?></h2>

                    <p> Du : <?= $row['start_date']?></p>
                    <p> Au : <?= $row['end_date']?></p>
                    <a href="delete_reza.php?id=<?= $row['id_annonce']?>">Annuler la réservation</a>

                </div>
            </div>
        </div>    
<?php
        }
    }





    function displayAnnonce($id){
        
        global $db;
        $sql = $db->query("SELECT * FROM annonces WHERE id = $id");
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $sql->fetch()){
            ?>
            <div class="col-4">
                <div class="card p-3">
                <h2>User n°<?= $row ['id'];?></h2>
                    <p>Type de bien : <?= $row['title'];?></p>
                    <p>Description : <?= $row['description'];?></p>
                    <p>Ville : <?= $row['city'];?></p>
                    <p>% du logement : <?= $row['category'];?></p>
                    <p>Adresse : <?= $row['address_article'];?></p>
                    <p>Prix : <?= $row['price'];?></p>
                    <p>Date de début : <?= $row['start_date'];?></p>
                    <p>Date de fin : <?= $row['end_date'];?></p>
                    <img src="assets/uploads/<?= $row['image_url'];?>" alt="">
                    <div class="col-12 text-center"><a class="nav-link" href="annonces.php">Retour aux annonces</a></div>
                    <div class="col-12 text-center"> <a name="reza" href="reza_post.php?id=<?=$row['id']?>">reserver </a></div>

                </div>
            </div>
        <?php
        }

    }

        

?>

<?php function  reza($id_annonce, $id_user){

    global $db;
    $sth=$db->prepare("INSERT INTO reservations (id_user,id_annonce) VALUES (:id_user, :id_annonce)");

    $sth->bindValue(':id_user',$id_user);
    $sth->bindValue(':id_annonce',$id_annonce);

    $sth->execute();

    $sth2=$db->prepare("UPDATE annonces SET active = 0 WHERE id=$id_annonce");
    $sth2->execute();
}

?>
    


