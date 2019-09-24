<?php
echo'<div class="card">
        <div class="card-body">
            <div class="card-title komentaro-autorius">
            <strong class="autorius">'.$row["Username"].'</strong>
                <div class="card-subtitle produkto-ivertinimas">
                    <div class="komentaro-ivertinimas">'.$row["Ivertinimas"].'</div>
                    <div class="card-text komentaro-paragrafas">'.$row["Komentaras"].'</div>
                </div>
                <div class="komentaro-data">'.$row["Data"].'</div>
            </div>
            <div class="trinti-komentara">';
            if(isset($_SESSION["show_admin"])){
                if($_SESSION["show_admin"] == "true"){
                    echo '<form action="" method="post">
                        <input type="button" name="" value="Trinti" class="delete-comment">
                    </form>';
                }
            }
        echo '</div>
        </div>
    </div>';
?>
