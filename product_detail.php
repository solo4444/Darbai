<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <?php include_once ("styles.php");  ?>

    <script type="text/javascript">
        $(document).ready(function () {
            var og_pavadinimas = $("#ProductNameInput").val();
            $(document).on('click', '.siusti-i-duombaze', function() {
                var produkto_pavadinimas = $("#ProductNameInput").val();
                var produkto_kaina = $("#ProductPriceInput").val();
                var produkto_kategorija = $("#CategoryInput").val();
                var produkto_aprasymas = $("#AprasymoInput").val();
                var produkto_nuotraukos_linkas = $("#PictureInput").val();


                if(produkto_pavadinimas.length > 0 && produkto_kaina.length > 0 && produkto_kategorija.length > 0 && produkto_aprasymas.length > 0 && produkto_nuotraukos_linkas.length > 0){
                    $.ajax({
                        type: "POST",
                        url: "update_product.php",
                        data: { pavadinimas: produkto_pavadinimas, kaina: produkto_kaina, aprasymas: produkto_aprasymas, kategorija: produkto_kategorija, nuotrauka: produkto_nuotraukos_linkas, og_pavadinimas: og_pavadinimas} ,
                        success: function(response) {
                            $(".status_messsage2").text(response);
                        }
                    });
                }
            });
        });
        </script>
    <body>


        <?php

        include_once ("header.php");
        include_once ("nav.php");
        include_once  ("model_view_controller.php");
        $results = get_product_data($_GET["pavadinimas"]);
        echo'<div class="container">';

    if(isset($_SESSION["logged_in_user"]) && isset($_SESSION["show_admin"])){
        if($_SESSION["logged_in_user"] == "kabakaba" && $_SESSION["show_admin"] == "true"){
            echo'<form class="upload-to-database" action="" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ProductNameInput">Produkto pavadinimas</label>
                        <input type="email" class="form-control" id="ProductNameInput" placeholder="Pavadinimas..." value="'.$results["Pavadinimas"].'">
                    </div>
                    <div class="form-group col-md-4 ml-5">
                        <label for="CategoryInput">Kategorija</label>
                        <select name="cars" class="form-control" id="CategoryInput" value="'.$results["Kategorija"].'">
                            <option value="'.$results["Kategorija"].'">'.$results["Kategorija"].'</option>
                            <option value="Starter kit\'ai">Starter kit\'ai</option>
                            <option value="Full size modai">Full size modai</option>
                            <option value="Mechaniniai">Mechaniniai</option>
                            <option value="Pod sistemos">Pod sistemos</option>
                            <option value="Klasikiniai skysčiai">Klasikiniai skysčiai</option>
                            <option value="Nikotino druskos skysčiai">Nikotino druskos skysčiai</option>
                            <option value="Premium klasės skysčiai">Premium klasės skysčiai</option>
                            <option value="CBD skysčiai">CBD skysčiai</option>
                            <option value="RDA">RDA</option>
                            <option value="RTA">RTA</option>
                            <option value="RDTA">RDTA</option>
                            <option value="MTL">MTL</option>
                            <option value="Kandikliai">Kandikliai</option>
                            <option value="Deklai">Deklai</option>
                            <option value="Gumytes">Gumytes</option>
                            <option value="Wrap\'ai">Wrap\'ai</option>
                            <option value="Stikliukai">Stikliukai</option>
                            <option value="Kaitinimo galvutes">Kaitinimo galvutes</option>
                            <option value="Baterijos">Baterijos</option>
                            <option value="Bateriju ikrovikliai">Bateriju ikrovikliai</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                <img src="css/'.$results["Nuotrauka"].'" alt="product photo" class="product-detail-photo col-5">
                    <div class="form-group col-md-7 mt-5">
                        <label for="AprasymoInput">Produkto Aprasymas</label>
                        <textarea class="form-control" rows="16" id="AprasymoInput" placeholder="Tekstas..." >'.$results["Aprasymas"].'</textarea>
                    </div>

                <div class="form-row mx-auto">
                    <div class="form-group col-md-9">
                        <label for="PictureInput">Nuotraukos link\'as</label>
                        <input type="text" class="form-control" id="PictureInput" placeholder="css/" value="'.$results["Nuotrauka"].'">


                    </div>
                    <div class="form-group col-md-3">
                            <label for="ProductPriceInput">Kaina</label>
                            <input type="number" class="form-control" id="ProductPriceInput" placeholder="$" value="'.$results["Kaina"].'">
                            <input type="button" name="Submit" value="Submit" class="btn btn-success siusti-i-duombaze" style="margin-left: 10%; margin-top: 5%;">
                    </div>
                </div>
            </div>
                <h3 class="status_messsage2"></h3>
            </form>
            <form class="rasyti-komentara-laukas" method="post">
            <div class="rating">
                <span><input type="radio" name="rating" id="str1" value="1"><label for="str1"></label></span>
                <span><input type="radio" name="rating" id="str2" value="2"><label for="str2"></label></span>
                <span><input type="radio" name="rating" id="str3" value="3"><label for="str3"></label></span>
                <span><input type="radio" name="rating" id="str4" value="4"><label for="str4"></label></span>
                <span><input type="radio" name="rating" id="str5" value="5"><label for="str5"></label></span>
            </div>
                <div class="form-group">
                    <textarea class="form-control komentaro-tekstas" id="KomentaroKlicka" rows="2" placeholder="Rašyti komentarą..."></textarea>
                </div>
                <button type="button" class="siusti-komentara btn btn-success">Submit</button>
            </form>';

        }
        else{
            echo '<div class="container product-detail-paragraph">
                <img src="css/'.$results["Nuotrauka"].'" alt="product photo" class="product-detail-photo col-5">
                <div class="product-info-paragraph col-6 row" >
                    <h3 class="produkto-pavadinimas">'.$results["Pavadinimas"].'</h3>
                    '.$results["Aprasymas"].'
                    <div class="row mt-5 ml-3">
                        <h5>Kaina: '.$results["Kaina"].'</h5>
                        <form action="" method="POST" class="add-to-cart ml-5">
                            <button type="button" name="Į krepšelį" class="add-to-shopping-cart-button btn-success">Į krepšelį</button>
                        </form>
                    </div>
                </div>

            </div>
            <form class="rasyti-komentara-laukas" method="post">
            <div class="rating">
                <span><input type="radio" name="rating" id="str1" value="1"><label for="str1"></label></span>
                <span><input type="radio" name="rating" id="str2" value="2"><label for="str2"></label></span>
                <span><input type="radio" name="rating" id="str3" value="3"><label for="str3"></label></span>
                <span><input type="radio" name="rating" id="str4" value="4"><label for="str4"></label></span>
                <span><input type="radio" name="rating" id="str5" value="5"><label for="str5"></label></span>
            </div>
                <div class="form-group">
                    <textarea class="form-control komentaro-tekstas" id="KomentaroKlicka" rows="2" placeholder="Rašyti komentarą..."></textarea>
                </div>
                <button type="button" class="siusti-komentara btn btn-success">Submit</button>
            </form>';

        }
    }else {
        echo '<div class="container product-detail-paragraph">
            <img src="css/'.$results["Nuotrauka"].'" alt="product photo" class="product-detail-photo col-5">
            <div class="product-info-paragraph col-6 row" >
                <h3 class="produkto-pavadinimas">'.$results["Pavadinimas"].'</h3>
                '.$results["Aprasymas"].'
                <div class="row mt-5 ml-3">
                    <h5>Kaina: '.$results["Kaina"].'</h5>
                    <form action="" method="POST" class="add-to-cart ml-5">
                        <button type="button" name="Į krepšelį" class="add-to-shopping-cart-button btn-success">Į krepšelį</button>
                    </form>
                </div>
            </div>

        </div>';
    } ?>

        <div class="produkto-komentarai">
            <div class="rasyti-komentara">







                <script type="text/javascript">
                $(document).ready(function(){
                    // Check Radio-box
                    $(".rating input:radio").attr("checked", false);

                    $('.rating input').click(function () {
                        $(".rating span").removeClass('checked');
                        $(this).parent().addClass('checked');
                    });

                    $('input:radio').change(
                        function (){
                            var userRating = this.value;

                        });
                    $(document).on('click', '.delete-comment', function() {
                        var username = $(this).parent().parent().children(".komentaro-autorius").children(".autorius").text();
                        var ivertinimas = $(this).parent().parent().children(".komentaro-autorius").children(".produkto-ivertinimas").children(".komentaro-ivertinimas").text();
                        var komentaras = $(this).parent().parent().children(".komentaro-autorius").children(".produkto-ivertinimas").children(".komentaro-paragrafas").text();
                        var data = $(this).parent().parent().children(".komentaro-autorius").children(".komentaro-data").text();
                            $.ajax({
                                type: 'POST',
                                url: 'trinti_komentara.php',
                                data: {Username: username, Komentaras: komentaras, Reitingas: ivertinimas, Data: data} ,
                                success: function(response) {
                                    

                                }

                            });
                        });
                    });
                    $(document).on('click', '.siusti-komentara', function() {
                        var atitinkaReikalavimus = false;

                        var komentaras = $(".komentaro-tekstas").val();

                        var reitingas = $("input[name='rating']:checked").val();

                        var d = new Date();

                        var dabartineData = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();

                        var produkto_pavadinimas = $(".product-info-paragraph h3").text();

                        alert(produkto_pavadinimas);
                        if(reitingas > 0 && komentaras.length < 1500){
                            atitinkaReikalavimus = true;
                        }

                        if(atitinkaReikalavimus){
                            $.ajax({
                                type: 'POST',
                                url: 'siusti_komentara.php',
                                data: { Produktas: produkto_pavadinimas, Komentaras: komentaras, Reitingas: reitingas, Data: dabartineData} ,
                                success: function(response) {
                                    alert(response);

                                }

                            });
                        }
                    });
                </script>

            </div>

            <div class="komentarai">
                <?php
                 include ("produkto_komentarai.php")?>
            </div>
        </div>

    </div>
    </body>
</html>
