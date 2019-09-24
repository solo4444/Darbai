<?php
echo '<header>
    <a href="index.php"><img src="css/company_logo.jpg" alt="company logo" width="20%" height="15%;" class="company-logo"></a>
    <div id="carouselExampleControls" class="carousel slide karusele" data-ride="carousel">
        <div class="carousel-inner" >
            <div class="carousel-item active">
                <img class="d-block w-100" src="css/pacha_mama_salts.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="css/salty_bastard.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="css/Snaku_Europe.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>';
    include "check-if-logged-in.php";
echo '</header>
'; ?>
