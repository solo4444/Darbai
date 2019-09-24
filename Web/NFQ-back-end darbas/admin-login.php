<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php include"styles.php"; ?>
  </head>
  <body>
    <?php include 'header.php'; ?>
  <div class="container">

      <div class="form-group">
        <label for="InputName">Administratoriaus vardas</label>
        <input type="name" name="vardas" class="form-control" id="InputName" placeholder="Iveskite vartotojo varda">
        <label for="InputName" class="error-name"></label>
      </div>
      <div class="form-group">
        <label for="InputPassword">Slaptazodis</label>
        <input type="password" name="slaptazodis" class="form-control" id="InputPassword" placeholder="Slaptazodis">
        <label for="InputPassword" class="error-password"></label>
      </div>
      <button type="submit" class="btn btn-primary submit">Submit</button>

    <script type="text/javascript">

      $(document).ready(function() {
        $.ajax({
              type: 'POST',
              url: 'check-if-admin-already-logged-in.php',
                   success: function(response) {
                     if(response == "true"){
                        location.href = "admin-panel.php";
                      }
                    }
              });

        $(document).on("click", ".submit", function() {

          var atitinkareikalavimus = false;
          var vardas = $("#InputName").val();
          var slaptazodis = $("#InputPassword").val();

          if(vardas.length > 7){
            if(slaptazodis.length > 7){
              atitinkareikalavimus = true;

            }
            else{
              $(".error-password").text("Slaptazodis per trumpas");
            }
          }
          else{
            $(".error-name").text("Vardas per trumpas");
          }
          if(atitinkareikalavimus){

            $.ajax({
                  type: 'POST',
                  url: 'check-admin-login.php',
                  data: { Name: vardas, Password: slaptazodis} ,
                       success: function(response) {
                         if(response == "true"){
                            location.href = "admin-panel.php";
                          }
                        }

            });
          }
        })
      })
    </script>
  </div>
  </body>
</html>
