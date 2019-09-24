<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
        <?php include "styles.php"; ?>
  </head>
  <body>
    <?php include "header.php"; ?>

    <div class="container">
      <h1>Iveskite klientą į eilę</h1>
        <div class="form-group">
          <label for="InputName">Kliento vardas</label>
          <input type="name" name="vardas" class="form-control" id="InputName" placeholder="Iveskite kliento varda">
          <label for="InputName" class="error-name"></label>
        </div>
        <div class="form-group">
          <label for="InputPassword">Kliento pavarde</label>
          <input type="name" name="pavarde" class="form-control" id="InputSurname" placeholder="Iveskite kliento pavarde">
          <label for="InputPassword" class="error-surname"></label>
        </div>
        <div class="form-group">
          <label for="InputSpecialist">Kliento specialistas</label>
          <input type="name" name="specialistas" class="form-control" id="InputSpecialist" placeholder="Iveskite kliento specialista">
          <label for="InputSpecialist" class="error-specialist"></label>
        </div>
        <button type="submit" class="btn btn-primary submit">Siųsti į eilę</button>
        <h3 id="status"></h3>
      </div>
      <script type="text/javascript">

        $(document).ready(function() {
          $(document).on("click", ".submit", function() {

            var atitinkareikalavimus = false;
            var vardas = $("#InputName").val();
            var pavarde = $("#InputSurname").val();
            var specialistas = $('#InputSpecialist').val();

            if(vardas.length > 1){
              if(pavarde.length > 1){
                if (specialistas.length > 1) {
                    atitinkareikalavimus = true;
                }
                else{
                  $(".error-specialist").text("Specialisto vardas per trumpas");
                }
              }
              else{
                $(".error-surname").text("Pavarde per trumpa");
              }
            }
            else{
              $(".error-name").text("Vardas per trumpas");
            }
            if(atitinkareikalavimus){

              $.ajax({
                    type: 'POST',
                    url: 'send-client-to-db.php',
                    data: { Name: vardas, Surname: pavarde, Specialist: specialistas} ,
                         success: function(response) {
                           $("#status").text(response);
                          }

              });
            }
          })
        })
      </script>

  </body>
</html>
