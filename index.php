<?php
    $page='index';
    require ('inc/connect.php');
    require ('inc/functions.php');


?>
<?php
require('assets/head.php');
include('assets/nav.php'); 

?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron jumbotron-fluid col-md-12 text-center my-4">
                    <h1 class="display-4">Bienvenue sur Stuliday !</h1>
                    <?php if(empty($_SESSION)){ ?> <p class="lead"> <br> <a href ='login.php'> Connectez-vous </a>ou<a href ='login.php'> Inscrivez-vous</a></p> <?php } ?>
                    <hr class="my-4">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="<?= random_image(2000,800); ?>" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src=" <?= random_image(2001,800); ?>" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="<?= random_image(1999,800); ?>" alt="Third slide">
                            </div>
                        </div>
                    </div>
                    
                </div>
        </div>
    </div>
</section>
<?php require('assets/footer.php'); ?>