


<?php
        require("../includes/common.php");


//get connection
$mysqli = new mysqli($config_databaseServer, $config_databaseUsername,  $config_databasePassword, $config_databaseName);

if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}

//Delete entries older than 90 days from graph table
$query = ("DELETE from graph where created_at < now() - interval 90 DAY;");

$mysqli->query("$query");
$mysqli->close();




?>  