<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php include 'styles.php'; ?>
  </head>
  <body>
    <?php include 'header.php';?>
    <div class="container">

    <?php include 'eiles-info-specialistui.php'; ?>
    <script type="text/javascript">
    $(document).ready(function() {

      $(document).on("click", ".aptarnauti", function() {
        var vardas = $.trim($(this).parent().parent().children().eq(0).text());
        var pavarde = $.trim($(this).parent().parent().children().eq(1).text());
        // alert(vardas);
        // alert(pavarde);
        $.ajax({
              type: 'POST',
              url: 'aptarnauti-klienta.php',
              data: {Vardas: vardas, Pavarde: pavarde},
                   success: function(response) {
                     alert(response);
                     location.href = "specialist-panel.php";
                    }
              });
      })
    })
    </script>
  </div>
  </body>
</html>
