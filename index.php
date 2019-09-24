<!DOCTYPE html>
<?php
if(!session_id()){session_start();}


$cookie_name = "shopping-cart-tracker";
if(!isset($_COOKIE[$cookie_name])){
$cookie_value = "";
setcookie($cookie_name, $cookie_value, time() + (86400*30), '/');
}

 ?>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Elektroninių cigarečių parduotuvė</title>
    </head>

    <?php include "styles.php" ?>

    <script type="text/javascript" >

    $(document).ready(function(){
    $(".product-card").mouseenter(function(){
        $(this).find("img").animate({
            paddingLeft:'3%',
            paddingRight:'3%',
            paddingTop:'3%',
            paddingBottom:'3%',
        }, 100);
    });
    $(".product-card").mouseleave(function(){
        $(this).find("img").animate({
            paddingLeft:'-6%',
            paddingRight:'-6%',
            paddingTop:'-6%',
            paddingBottom:'-6%',
        }, 100);
    });
    $(".kategorijos-sekcija ul ul li a").click(function() {
        var x = $(this).text();
        $.ajax({
            type: 'POST',
            url: 'category-filter.php',
            data: { category: x} ,
            success: function(response) {
                $(".products-paragraph").empty();
                $(".products-paragraph").append(response);
            }
        });

    });
    $(document).on("click", ".logout-button", function(){
        $.ajax({
            type: "POST",
            url: "logout.php",
            success: function(response) {
                location.href = "index.php";
            }

        });

    });
    $(document).on("click", ".show-user-button", function(){
        $.ajax({
            type: "POST",
            url: "show-diffrent-view.php",
            data: { what_to_show: "user"} ,
            success: function(response) {

                location.href = "index.php";
            }

        });

    });
    $(document).on("click", ".show-admin-button", function(){
        $.ajax({
            type: "POST",
            url: "show-diffrent-view.php",
            data: { what_to_show: "admin"} ,
            success: function(response) {
                location.href = "index.php";
            }

        });

    });

    $(document).on("click", ".login-button", function(){
        var message, username, password;
        message = $('#error_code').val();
        message.innerHTML = "";
        username = $('#login_username').val();
        password = document.getElementById('login_password').value;
        $('.login-button').popover('dispose');
        try {
            if(username.length < 7 && password.length < 7){
                throw "username and password are too short";
            }
            else if(username.length < 7){
                throw "username is too short";
            }
            else if(password.length < 7){
                throw "password is too short";
            }
            else{
                window.login_parameters_checked = true;
            }

        } catch (err) {
            $('.login-button').popover({title:"Something went wrong!", content: err, placement: "bottom"});
            $('.login-button').popover('show');
        }

        var user_username = $("#login_username");
        var user_password = $("#login_password");

        if(window.login_parameters_checked == true){
            $.ajax({
                type: 'POST',
                url: 'login-check.php',
                data: { user_username: username, user_password: password} ,
                success: function(response) {
                    location.href = "index.php";

                }

            });

        }

    });

    });

    // TODO:   uzsakymai, uzsakymu puslapis, uzsakymu istorija, rekvizitai, parduotuves,footer, media group, sutvarkyti koda, stiliai

    </script>

    <body>


        <?php include "shopping_cart_box.php" ?>
        <div class="shopping-cart-menu">
             <?php  include "update-from-cookies.php"?>

            <script type="text/javascript">

            $(document).ready(function(){
                var matched = $(".shopping-cart-menu .product-in-cart-card");
                $(".item-counter").text(matched.length);
                $(".add-to-cart").click(function(){
                var x = $(this).parent().parent().children("a").children("div").text();
                    $.ajax({
                        type: "POST",
                        url: "shopping_cart.php",
                        data: { product_name: x} ,
                        success: function(response) {
                            $(".shopping-cart-menu").append(response);
                            var matched = $(".shopping-cart-menu .product-in-cart-card");
                            $(".item-counter").text(matched.length);
                        }

                    });

                });
                $(document).on("click", ".remove-from-cart", function(){
                    var x = $(this).parent().parent().children("a").children("div").text();
                    var removable = "." + $(this).parent().parent().attr("class");
                    $.ajax({
                        type: "POST",
                        url: "shopping_cart_removal.php",
                        data: { product_name: x} ,
                        success: function(response) {
                            $(".card.product-in-cart-card:contains("+x+")").remove();
                            var matched = $(".shopping-cart-menu .product-in-cart-card");
                            $(".item-counter").text(matched.length);
                        }
                    });
                });
            });

            </script>

        </div>

        <?php include "header.php" ?>



        <?php include "nav.php"?>

        <?php //include "main_content.php" ?>

        <div class="container">

            <div class="main-content">
                <!-- side-bar-menu -->
                <div class="col-3 border d-inline-flex kategorijos-sekcija">
                    <ul>
                        <ul>
                            Modai:
                            <li><a>Starter kit'ai</a></li>
                            <li><a>Full size modai</a></li>
                            <li><a>Mechaniniai</a></li>
                            <li><a>Pod sistemos</a></li>
                        </ul>
                        <ul>
                            Skysčiai:
                            <li><a>Klasikiniai skysčiai</a></li>
                            <li><a>Nikotino druskos skysčiai</a></li>
                            <li><a>Premium klasės skysčiai</a></li>
                            <li><a>CBD skysčiai</a></li>
                        </ul>
                        <ul>
                            Kaitikliai:
                            <li><a>RDA</a></li>
                            <li><a>RTA</a></li>
                            <li><a>RDTA</a></li>
                            <li><a>MTL</a></li>
                        </ul>
                        <ul>
                            Aksesuarai:
                            <li><a>Kandikliai</a></li>
                            <li><a>Deklai</a></li>
                            <li><a>Gumytes</a></li>
                            <li><a>Wrap'ai</a></li>
                        </ul>
                        <ul>
                            Priedai:
                            <li><a>Stikliukai</a></li>
                            <li><a>Kaitinimo galvutes</a></li>
                            <li><a>Baterijos</a></li>
                            <li><a>Bateriju ikrovikliai</a></li>
                        </ul>
                    </ul>
                </div>
                <!-- products-paragraph -->
                <div class="col-9 border d-inline-flex ml-5 products-paragraph">
                    <?php include "results.php" ?>
                </div>
                <div class="row ">

                </div>
            </div>
        </div>


        <div class="shopping-cart-icon">

            <img src="css/shopping_cart.svg" alt="shopping cart" height="50px" width="50px">
            <h3 class="item-counter"></h3>
        </div>

    </body>

<script type="text/javascript" src="main.js" >


</script>


</html>
