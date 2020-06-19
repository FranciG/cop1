

<div class='row pt_p'>

    


<?php
// print $product_main["ean"]; 
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
      google.charts.load('current', {'packages':['bar']});
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
          chart: {
            title: 'El grafico representa la evolución de precios del producto en funcion del tiempo',
            subtitle: 'Format: Day/Month/Year - Hour',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }







     


    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>


<body>

<div id="columnchart_material" style="width: 800px; height: 500px;"></div>
<br>
<br>


</body>
</html>

</div>


   