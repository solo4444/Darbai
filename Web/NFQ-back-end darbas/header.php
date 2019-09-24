<?php
if(isset($_SESSION["admin_logged_in"])){
  if($_SESSION["admin_logged_in"] == "true"){
    echo '<header>
      <h1><a href="index.php">Švieslentė</a></h1>
      <ul>
        <li><a href="specialist-login.php">Specialisto puslapis</a></li>
        <li><a href="customer-login.php">Lankytojo puslapis</a></li>
        <li><a href="admin-login.php">Administravimo puslapis</a></li>
      </ul>
      <h2 class="atsijungti">Atsijungti</h2>
    </header>
    <script type="text/javascript">
    $(document).ready(function() {

      $(document).on("click", ".atsijungti", function() {
        $.ajax({
              type: \'POST\',
              url: \'session-destroy.php\',
                   success: function(response) {
                     location.href = "index.php";
                    }
              });
      })
    })
    </script>';
  }
}
  else if(isset($_SESSION["specialist_logged_in"]) && isset($_SESSION["logged_in_specialist"])){
    if($_SESSION["specialist_logged_in"] == "true"){
      echo '<header>
        <h1><a href="index.php">Švieslentė</a></h1>
        <ul>
          <li><a href="specialist-login.php">Specialisto puslapis</a></li>
          <li><a href="customer-login.php">Lankytojo puslapis</a></li>
          <li><a href="admin-login.php">Administravimo puslapis</a></li>
        </ul>
        <h2 class="atsijungti">Atsijungti</h2>
        <h3>Sveiki '.$_SESSION["logged_in_specialist"].'</h3>
      </header>
      <script type="text/javascript">
      $(document).ready(function() {

        $(document).on("click", ".atsijungti", function() {
          $.ajax({
                type: \'POST\',
                url: \'session-destroy.php\',
                     success: function(response) {
                       location.href = "index.php";
                      }
                });
        })
      })
      </script>';
    }
  }

else{
echo '<header>
  <h1><a href="index.php">Švieslentė</a></h1>
  <ul>
    <li><a href="specialist-login.php">Specialisto puslapis</a></li>
    <li><a href="customer-login.php">Lankytojo puslapis</a></li>
    <li><a href="admin-login.php">Administravimo puslapis</a></li>
  </ul>
</header>';
}?>
