<?php 
    $page ='profile';
    require('inc/connect.php');
    require('inc/functions.php'); 
    require('assets/head.php');
    include('assets/nav.php');
    
    
    $id = $_SESSION['id'];

    $sql = $db->query("SELECT COUNT(*) FROM `annonces` WHERE author_article = $id");
    $compteur = $sql->fetchColumn();

    $sql2 = $db->query("SELECT * FROM users WHERE id=$id ");

    $row=$sql2->fetch();

    $sql3 = $db->query("SELECT COUNT(*) FROM `reservations` WHERE id_user = $id");
    $compteur2 = $sql3->fetchColumn();

    
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="py-4">Mon profil :</h2>
            </div>
            <div class="col-md-8">
                <form action="edit_post.php" method="post" >
                    <div class="form-group">
                        <label for="exampleInputEmail">Nom</label>
                        <input type="text" class="form-control" name="lastName" id="exampleInputEmail"
                            aria-describedby="emailHelp" placeholder="Nom" value="<?= $row['lastName'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Prénom</label>
                        <input type="text" name="firstName" class="form-control" id="exampleInputPassword"
                            placeholder="Prénom" value="<?= $row['firstName'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail"
                            aria-describedby="emailHelp" value="<?= $row['email'] ?>" placeholder="Email">
                    </div>
                    <input type="submit" name="submit_update" class="btn btn-info" value="Mettre à jour">
                    <a   href="delete_post.php?id=<?= $id ?>" class="btn btn-danger">Supprimer le profil</a>
                </form>
                
            </div>
            <div class="col-md-4">
                <a href="create-annonce.php" class="btn btn-primary mb-3">Publier une nouvelle annonce</a>
                <a href="#" class="btn btn-primary mb-3 <?php  if($compteur < 1){ echo 'disabled'; } ?>"
                    data-toggle="modal" data-target="#listingAnnonces">Voir mes annonces  <span class="badge badge-primary badge-pill"><?= $compteur; ?></span>
                    </a>
                <a href="#" class="btn btn-primary mb-3 <?php  if($compteur2 < 1){ echo 'disabled'; } ?>"
                    data-toggle="modal" data-target="#mesreservations">Voir mes réservations <span class="badge badge-primary badge-pill"><?= $compteur2; ?></span></a>
            </div>
            <div class="col-md-12 text-center pt-5 my-2">
                <a class="btn btn-info back" href="annonces.php">Retour aux annonces</a>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="listingAnnonces" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog listings" role="document">
        <div class="modal-content text-center">
            <div class="modal-header" id="popup" class="overlay">
                <h5 class="modal-title" id="exampleModalLabel">Mes annonces</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
            <div class="row ">
            <?php
                displayModalAnnonces($id);
            ?>
             </div>
        
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mesreservations" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog listings" role="document">
        <div class="modal-content text-center">
            <div class="modal-header" id="popup" class="overlay">
                <h5 class="modal-title" id="exampleModalLabel">Mes réservations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
            <div class="row ">
            <?php
                displayreza($id);
            ?>
             </div>
        
            </div>
        </div>
    </div>
</div>

<?php require('assets/footer.php'); ?>