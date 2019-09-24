<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php include 'styles.php'; ?>
  </head>
  <body>
    <?php include 'header.php'; ?>
    <div class="container">
      <div class="form-group">
        <label for="InputName">Vardas</label>
        <input type="name" name="vardas" class="form-control" id="InputName" placeholder="Vardas">
        <label for="InputName" class="error-name"></label>
      </div>
      <div class="form-group">
        <label for="InputSurname">Pavarde</label>
        <input type="name" name="pavarde" class="form-control" id="InputSurname" placeholder="Pavarde">
        <label for="InputSurname" class="error-surname"></label>
      </div>
      <div class="form-group">
        <label for="InputPin">PIN</label>
        <input type="number" name="pin" class="form-control" id="InputPin" placeholder="PIN">
        <label for="InputPin" class="error-pin"></label>
      </div>
      <button type="submit" class="btn btn-primary submit">Jungtis</button>
        <label for="InputPin" class="status"></label>
    </div>
    <script type="text/javascript">

      $(document).ready(function() {
        $(document).on("click", ".submit", function() {

          var atitinkareikalavimus = false;
          var vardas = $("#InputName").val();
          var pavarde = $("#InputSurname").val();
          var pin = $("#InputPin").val();

          if(vardas.length > 1){
            if(pavarde.length > 1){
              if(pin > 1000){
                atitinkareikalavimus = true;
              }
              else{
                $(".error-pin").text("PIN per trumpas");
              }

            }
            else{
              $(".error-surname").text("Pavarde per trumpas");
            }
          }
          else{
            $(".error-name").text("Vardas per trumpas");
          }
          if(atitinkareikalavimus){

            $.ajax({
                  type: 'POST',
                  url: 'check-customer-login.php',
                  data: { Name: vardas, Surname: pavarde, Pin: pin} ,
                       success: function(response) {
                         alert(response);
                         if(response == "false"){
                              $(".status").text(response);
                          }
                          else{
                            location.href = response;
                          }
                        }

            });
          }
        })
      })
    </script>
  </body>
</html>
