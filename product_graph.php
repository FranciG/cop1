

<div class='row pt_p'>

    


<?php
 print $product_main["ean"]; 
//The variable is there, since it prints
?> 

    

<?php
  


//get connection
$mysqli = new mysqli($config_databaseServer, $config_databaseUsername,  $config_databasePassword, $config_databaseName);

if(!$mysqli){
die("Connection failed: " . $mysqli->error);
}

//Query 
$query = ("SELECT * FROM graph WHERE ean IN ('".$product_main["ean"]."') group by DAY(created_at);");




$result = mysqli_query($mysqli, $query); 



 //Display query results
while ($row=mysqli_fetch_assoc ($result)) {

echo "['".$row["ean"]."', ".$row["created_at"].",".$row["avg_price"]."],<br>";
} 

?>   

</div>


   