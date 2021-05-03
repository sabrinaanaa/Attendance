<?php
$page = $_SERVER['PHP_SELF'];
$sec = "999";


$today = date('d/m/y',time());
$year= substr($today,6,2);

$month = substr($today,3,2)."/".$year;





 $dbName = "c:\\xampp\\htdocs\\Attendance\\att2000.mdb";
if (!file_exists($dbName)) {
    die("Could not find database file.");
}
$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=$dbName; Uid=; Pwd=;");

$year="2021";

/*
$sql = 'SELECT * from CHECKINOUT where substr(`CHECKTIME`,7,4) = '.$year.'';
$sql = sprintf("SELECT * from CHECKINOUT where substr(`CHECKTIME`,7,4) = '$year'");

$sql = 'SELECT * from CHECKINOUT';
$sql = sprintf("SELECT * from CHECKINOUT WHERE USERID = 142");

$sql = 'SELECT * from CHECKINOUT where substr(`CHECKTIME`,1,2) = 0';
*/

$sql = 'SELECT * from CHECKINOUT where Mid(`CHECKTIME`,7,4) = 2021';



?>

 <?php include ("head.php"); ?>
 
<script>
    window.onload = function () {
      var total = <?php echo json_encode($total); ?>;
	
    var chart = new CanvasJS.Chart("chartContainer", {
    	title: {
    		text: "Prix Communications\n   Total Mois = "+total+""
    	},
    	axisY: {
    		title: "Prix en Dinars"
    	},
    	data: [{
    		type: "line",
    		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    	}]
    });
    chart.render();
     
    }
    </script> 

<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page ?>'">
 </head>
  <body>
  

<?php
 
$today = date('d/m/y',time());

$id=0;




	

$j=0;
$linenr=1;	
   
	
	 
	 	
	 
	 

    
    ?>

  
 <?php include ("top.php"); ?>
  
  <!-- Side -->
  <div class="container-fluid">
  <div class="row">
   <?php include ("side.php"); ?>
   
<?php include ("center.php"); 



?>

 	 <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
 <!-- <div id="chartContainer" style="height: 370px; width: 100%;"></div> 
   <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
	 

<h2>Pointages</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>USERID</th>
			  <th>CHECKTIME</th>
			  
              
              
             
            </tr>
          </thead>
          <tbody>
            
           
		 <?php

   foreach  ($db->query($sql) as $row) {
    
   

		
		
				$bgcolor = $j % 2 === 0 ? "#DCDCDC" : "#A9A9A9";
		echo "<tr><td><div id='date".$id."'>".$row['USERID']."</div></td><td><div id='time".$id."'>".$row['CHECKTIME']."</div></td></tr>";	
	 
	   
	   
	  
	   $id++;
	    $j++; 
	  }
		?>
		   </tbody>
        </table> 
  </div>
		<br>
		
   <?php include ("footer.php"); ?>