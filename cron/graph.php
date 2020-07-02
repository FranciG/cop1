


<?php
        require("../includes/common.php");


//get connection
$mysqli = new mysqli($config_databaseServer, $config_databaseUsername,  $config_databasePassword, $config_databaseName);

if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}

//Insert into the table used for price tracking (graph) from the table pt_products only average from price
//$query = ("INSERT into graph (ean, avg_price) select ean, round(avg(price),2) avg_price from pt_products group by ean");


//Insert into the table used for price tracking (graph) from the table pt_products average from price, min price and max price of each ean for any vendor
$query = ("INSERT into graph (ean, avg_price, high_price, low_price) select ean, round(avg(price),2) avg_price, (max(price)) max_price, (min(price)) min_price from pt_products group by ean;");

//TODO: Change database fields high_price and low_price to  max_price and min_price
$mysqli->query("$query");
$mysqli->close();




?>  