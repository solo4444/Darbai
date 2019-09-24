<!DOCTYPE html>
<?php  session_start();?>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <?php include_once ("styles.php");  ?>
    <body>

        <?php
        include_once ("header.php");
        include_once ("nav.php");
        include_once  ("model_view_controller.php"); ?>
        <div class="container">
            <?php include ("check_if_admin.php") ?>
        </div>
    </body>

    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.siusti-i-duombaze', function() {
                var produkto_pavadinimas = $("#ProductNameInput").val();
                var produkto_kaina = $("#ProductPriceInput").val();
                var produkto_kategorija = $("#CategoryInput").val();
                var produkto_aprasymas = $("#AprasymoInput").val();
                var produkto_nuotraukos_linkas = $("#PictureInput").val();
                if(produkto_pavadinimas.length > 0 && produkto_kaina.length > 0 && produkto_kategorija.length > 0 && produkto_aprasymas.length > 0 && produkto_nuotraukos_linkas.length > 0){
                    $.ajax({
                        type: "POST",
                        url: "upload_product.php",
                        data: { pavadinimas: produkto_pavadinimas, kaina: produkto_kaina, aprasymas: produkto_aprasymas, kategorija: produkto_kategorija, nuotrauka: produkto_nuotraukos_linkas} ,
                        success: function(response) {
                            $(".status_messsage2").text(response);
                        }
                    });
                }
            });
            $(document).on('click', '.siusti', function() {
                var email = $("#outputEmail").val();
                var current_password = $("#CurrentPassword").val();
                var new_password = $("#NewPassword").val();
                var repeat_new_password = $("#RepeatNewPassword").val();
                if(new_password == repeat_new_password){
                    $.ajax({
                        type: "POST",
                        url: "info_update.php",
                        data: { new_email: email, password: current_password, new_password: new_password} ,
                        success: function(response) {
                            $(".status_messsage1").text(response);
                        }
                    });
                }
            });
        })
    </script>
</html>
