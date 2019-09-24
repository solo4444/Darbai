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
        <label for="InputName">Specialisto vardas</label>
        <input type="name" name="vardas" class="form-control" id="InputName" placeholder="Iveskite vartotojo varda">
        <label for="InputName" class="error-name"></label>
      </div>
      <div class="form-row">
      <div class="form-group col-md-6">
        <label for="InputPassword">Slaptazodis</label>
        <input type="password" name="slaptazodis" class="form-control" id="InputPassword" placeholder="Slaptazodis">
        <label for="InputPassword" class="error-password"></label>
      </div>
      <div class="form-group col-md-6">
        <label for="RepeatInputPassword">Pakartokite Slaptazodi</label>
        <input type="password" name="pslaptazodis" class="form-control" id="RepeatInputPassword" placeholder="Pakartokite Slaptazodi">
        <label for="RepeatInputPassword" class="error-repeat-password"></label>
      </div>
      </div>
      <div class="form-group col-md-3">
        <label for="InputPin">PIN kodas</label>
        <input type="name" name="vardas" class="form-control" id="InputPin" placeholder="Iveskite PIN">
        <label for="InputPin" class="error-pin"></label>
      </div>
      <button type="submit" class="btn btn-primary submit">Submit</button>
      <p id="status"></p>


    <script type="text/javascript">

      $(document).ready(function() {
        $(document).on("click", ".submit", function() {

          var atitinkareikalavimus = false;
          var vardas = $("#InputName").val();
          var slaptazodis = $("#InputPassword").val();
          var pslaptazodis = $("#RepeatInputPassword").val();
          var pin = $("#InputPin").val();

          if(vardas.length > 7){
            if(slaptazodis.length > 7){
              if(pslaptazodis == slaptazodis){
                atitinkareikalavimus = true;
              }
              else{
                $(".error-repeat-password").text("Slaptazodiai nesutampa");
              }
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
                  url: 'upload-specialist-register.php',
                  data: { Name: vardas, Password: slaptazodis, Pin: pin} ,
                       success: function(response) {
                         $("#status").text(response);
                        }

            });
          }
        })
      })
    </script>
  </div>
  </body>
</html>
