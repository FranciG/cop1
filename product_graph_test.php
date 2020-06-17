<?php
   require_once("../includes/common.php");
  $product_main['ean'] = '00000000271686';


//get connection
$mysqli = new mysqli($config_databaseServer, $config_databaseUsername,  $config_databasePassword, $config_databaseName);

if(!$mysqli){
die("Connection failed: " . $mysqli->error);
}

//Query
$query = ("SELECT * FROM graph WHERE ean IN ('$product_main['ean']') group by DAY(created_at);");




$result = mysqli_query($mysqli, $query); 



//Only to display the results
while ($row=mysqli_fetch_assoc ($result)) {
echo "{$row['ean']}<br>";
}

?>   



   