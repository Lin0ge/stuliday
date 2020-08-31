<?php

    $id = $_SESSION['id'];

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
        $sql = $db->query("SELECT * FROM annonces");
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $sql->fetch()){
            ?>
            <div class="col-4">
                <div class="card p-3">
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
                    <a class="nav-link" href="annonces.php">Retour aux annonces</a>

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
                <h2>User n°<?= $row ['id'];?></h2>
                    <p><?= $row['title'];?></p>
                    <p><?= $row['city'];?></p>
                    <p><?= $row['address_article'];?></p>
                    <p><?= $row['price'];?></p>
                    <a class="nav-link" href="edit_annonce.php?id=<?= $row ['id']; ?>">Modifier</a>
                    <a class="nav-link" href="#">Supprimer</a>
                    

                </div>
            </div>
        <?php
        }

    }
    


