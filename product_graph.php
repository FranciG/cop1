



<div class='row pt_p'>

    


<?php
// print $product_main["ean"]; 
//The variable is there, since it prints

/* This file should be included as:

if (isset($product)) require("html/product_graph.php");

To the file products.php */
?> 

    

<?php
  


//get connection
$mysqli = new mysqli($config_databaseServer, $config_databaseUsername,  $config_databasePassword, $config_databaseName);

if(!$mysqli){
die("Connection failed: " . $mysqli->error);
}

//Query 
//$query = ("SELECT * FROM graph WHERE ean IN ('".$product_main["ean"]."') group by DAY(created_at);");

//"=" Operator used because comparing against 1 value only
// function DATE() to get only the date part from created_at
//correlated subquery in the WHERE clause to get the row with the minimum id (since it does not matter whic row will be returned) of each day
/* $query= ("SELECT g.id, g.ean, g.avg_price, DATE_FORMAT(g.created_at, '%d-%m-%Y') created_at
FROM graph g
WHERE g.ean = '".$product_main["ean"]."'
AND g.id = (SELECT MIN(id) FROM graph WHERE ean = g.ean AND DATE(created_at) = DATE(g.created_at))"); */

//New query to add min price and max price
$query= ("SELECT g.id, g.ean, g.avg_price, g.max_price, g.min_price DATE_FORMAT(g.created_at, '%d-%m-%Y') created_at
FROM graph g
WHERE g.ean = '".$product_main["ean"]."'
AND g.id = (SELECT MIN(id) FROM graph WHERE ean = g.ean AND DATE(created_at) = DATE(g.created_at))");

$result = mysqli_query($mysqli, $query); 

//TODO: Add the additional database fields

/*  //Display query results
while ($row=mysqli_fetch_assoc ($result)) {

echo "['".$row["ean"]."', ".$row["created_at"].",".$row["avg_price"]."],<br>";
}  */

?>   


<!DOCTYPE html>
<html>
<head> 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MySQL graphics</title>
    <html>
  <head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);



      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Fecha/hora', 'Precio'],
          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["created_at"]."', ".$row["avg_price"]."],";  
                          }  
                          ?>  
        ]);

        var options = {
          title: 'Precio promedio últimos 90 días',
          curveType: 'function',
          legend: { position: 'bottom' },
          hAxis: {
      title: 'Fecha'
    },
    vAxis: {
      title: 'Pesos mexicanos'
    }

        };

        

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));


        chart.draw(data, options);
      }







     


    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>


<body>

<div id="curve_chart" style="width: 900px; height: 500px"></div>

<br>
<br>


</body>
</html>

</div>