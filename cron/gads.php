


<?php
        require("../includes/common.php");


//get connection
$mysqli = new mysqli($config_databaseServer, $config_databaseUsername,  $config_databasePassword, $config_databaseName);

if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}

//Query to get a list of ean when Amazon is the cheapest seller and there is more than one different seller
$query = ("SELECT * from pt_products
where ean in (
    select ean
    from pt_products
    group by ean
    having min(price) = min(case when merchant = 'Amazon' then price end) 
       and sum(merchant <> 'Amazon') > 0 
)
and merchant = 'Amazon'
");




$result = mysqli_query($mysqli, $query); 
//Exporting to csv. Going up one directory, then saving to gads folder
$output = fopen('../gads/gads.csv', 'w');

while ($row=mysqli_fetch_assoc ($result)) fputcsv($output, [$row['ean']]);

fclose($output);

//To display the results:
//echo "{$row['ean']}<br>";
//}
//Only to display the results
//while ($row=mysqli_fetch_assoc ($result)) {
//echo "{$row['ean']}<br>";
//}

?>  
     


