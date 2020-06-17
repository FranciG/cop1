


<?php
        require("../includes/common.php");


//get connection
$mysqli = new mysqli($config_databaseServer, $config_databaseUsername,  $config_databasePassword, $config_databaseName);

if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}

//Inset into the table used for price tracking (graph) from the table pt_products
$query = ("INSERT into graph (ean, avg_price) select ean, round(avg(price),2) avg_price from pt_products group by ean");






?>  