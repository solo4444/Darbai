<?php
if(isset($_SESSION["logged_in_user"]) && isset($_SESSION["show_admin"])){
    include_once  ("model_view_controller.php");
    $results = get_user_info_by_username($_SESSION["logged_in_user"]);
    $mail = $results->fetch_assoc();
    if($_SESSION["logged_in_user"] == "kabakaba" && $_SESSION["show_admin"] == "true"){
        echo '<form class="" action="" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <h2 class="current_username">Username: '.$_SESSION["logged_in_user"].'</h2>
                </div>
                <div class="form-group col-md-6">
                    <label for="outputEmail">El. Pastas</label>
                    <input type="email" class="form-control" id="outputEmail" placeholder="" value="'.$mail["Email"].'">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword">Current Password</label>
                    <input type="password" class="form-control" id="CurrentPassword" placeholder="Password...">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword">New Password</label>
                    <input type="password" class="form-control" id="NewPassword" placeholder="Password...">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword">Repeat New Password</label>
                    <input type="password" class="form-control" id="RepeatNewPassword" placeholder="Password...">
                </div>
            </div>
            <input type="button" name="Submit" value="Submit" class="btn btn-success siusti">
            <h3 class="status_messsage1"></h3>
        </form>

        <h2 style="margin-left: 30%">Ikelti i duomenu baze duomenis</h2>

        <form class="upload-to-database" action="" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="ProductNameInput">Produkto pavadinimas</label>
                    <input type="email" class="form-control" id="ProductNameInput" placeholder="Pavadinimas...">
                </div>
                <div class="form-group col-md-2">
                    <label for="ProductPriceInput">Kaina</label>
                    <input type="number" class="form-control" id="ProductPriceInput" placeholder="$">
                </div>
                <div class="form-group col-md-4">
                    <label for="CategoryInput">Kategorija</label>
                    <select name="cars" class="form-control" id="CategoryInput">
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
                <div class="form-group col-md-8">
                    <label for="AprasymoInput">Produkto Aprasymas</label>
                    <textarea class="form-control" rows="5" id="AprasymoInput" placeholder="Tekstas..."></textarea>
                </div>
                <div class="form-group col-md-4">
                    <label for="PictureInput">Nuotraukos link\'as</label>
                    <input type="text" class="form-control" id="PictureInput" placeholder="css/">
                    <input type="button" name="Submit" value="Submit" class="btn btn-success siusti-i-duombaze" style="margin-left: 10%; margin-top: 5%;">
                </div>
            </div>
            <h3 class="status_messsage2"></h3>
        </form>';
    }
    else{

        echo '<form class="" action="" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <h2 class="current_username">Username: '.$_SESSION["logged_in_user"].'</h2>
                </div>
                <div class="form-group col-md-6">
                    <label for="outputEmail">El. Pastas</label>
                    <input type="email" class="form-control" id="outputEmail" placeholder="" value="'.$mail["Email"].'">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword">Current Password</label>
                    <input type="password" class="form-control" id="CurrentPassword" placeholder="Password...">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword">New Password</label>
                    <input type="password" class="form-control" id="NewPassword" placeholder="Password...">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword">Repeat New Password</label>
                    <input type="password" class="form-control" id="RepeatNewPassword" placeholder="Password...">
                </div>
            </div>
            <input type="button" name="Submit" value="Submit" class="btn btn-success siusti">
            <h3 class="status_messsage1"></h3>
        </form>';
    }
}
 ?>
