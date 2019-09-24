<?php



echo"<a href=\"\"><div class=\"card product-in-cart-card \">";
echo"<div class=\"card-body\">";
echo"<h5 class=\"card-title product-name\">".$row["Pavadinimas"]."</h5>";
echo"</div>";
echo"</a><img class=\"card-img-top\" src=\"css/".$row["Nuotrauka"]."\"alt=\"Card image\" height=\"100px\" width=\"100px\">";
echo"<div class=\"card-body\">";
echo"<h5 class=\"card-title\">".$row["Kaina"]."</h5>";
echo "<form action=\"\" method=\"POST\" class=\"remove-from-cart\">";
echo"<button type=\"button\" name=\"Remove\" class=\"remove-from-shopping-cart-button btn-danger\">Remove</button>";
echo "</form>";
echo"</div>";
echo "</div>";
echo "<br>";


?>
