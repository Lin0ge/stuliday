<?php 
    $page='annonce';
    require('inc/connect.php');
    require('inc/functions.php');
    require('assets/head.php');
    include('assets/nav.php');
    
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">    
                <h1>Description de l'annonce :</h1>
            </div>
        </div>
        
        <div class="row">
            <?php
                $id = $_GET['id'];
                displayAnnonce($id);
            
            
        
            ?>
        </div>
    </div>
</section>
<?php require('assets/footer.php'); ?>











