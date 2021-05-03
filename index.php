<?php
$page = $_SERVER['PHP_SELF'];
$sec = "999";


$today = date('d/m/y',time());


$year = "20".substr($today,6,2);
$month = substr($today,3,2);
$day = substr($today,0,2);

/*$month = substr($today,3,2)."/".$year;

$day = substr($today,0,5)."/".$year;*/





 $dbName = "C:\\xampp\\htdocs\\Attendance\\att2000.mdb";
if (!file_exists($dbName)) {
    die("Could not find database file.");
}
$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=$dbName; Uid=; Pwd=;");
$yeartotext=strval($year);


$sql = 'SELECT * from CHECKINOUT where Mid(`CHECKTIME`,7,4) = '.$year.' and Mid (`CHECKTIME`,4,2) ='.$month.' and Mid (`CHECKTIME`,1,2) ='.$day.'';



/*
SELECT * from CHECKINOUT, USERINFO where Mid(`CHECKTIME`,7,4) =2021 and USERINFO.USERID = 712;
*/








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
 <!--  Working Canvas
 	<canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
-->

	
 <!-- <div id="chartContainer" style="height: 370px; width: 100%;"></div> 
   <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
	 
<?php 
echo "Aujourd hui est le ";  
echo strval($day)."/";  
echo strval($month)."/";
echo strval($year);
?>
<h2>Employes</h2>
      <div class="table-responsive" id="99">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Departement</th>
			  <th>Nom Employee</th>
			  <th>Matricule</th>
			  <th>CHECKTIME</th>
			 
			  
              
              
             
            </tr>
          </thead>
		  
		  
          <tbody>
            
           
		 <?php

   foreach  ($db->query($sql) as $row) {
	   
	  /*
	  $sqlU = 'SELECT * from USERINFO where `USERINFO.USERID` = `CHECKINOUT.USERID`';
	   $sqlD = 'SELECT * from DEPARTMENTS where `DEPARTMENTS.DEPTID` = `USERINFO.DEFAULTDEPTID`';
	   
	   
    foreach  ($db->query($sqlU) as $rowU) {
		
		foreach  ($db->query($sqlD) as $rowD) {
   
*/
	/*	if ($row['CHECKINOUT.USERID']==$row['USERINFO.USERID'] && $row['USERINFO.DEFAULTDEPTID']==$row['DEPARTMENTS.DEPTID']){ 
		
		SELECT * from Contacts where Numero= '$tel'
		
		<td><div id='date".$id."'>".$row['DEPTNAME']."</div></td>
	<td><div id='time".$id."'>".$row['Badgenumber']."</div></td>
	<td><div id='date".$id."'>".$row['Name']."</div></td>
	<td><div id='time".$id."'>".$row['CHECKTIME']."</div></td>
		
		*/
				$bgcolor = $j % 2 === 0 ? "#DCDCDC" : "#A9A9A9";
				
				
	
	/*Table employee*/
	$sql1 = 'SELECT * from USERINFO where USERID= '.$row['USERID'].'';
	foreach  ($db->query($sql1) as $row1) {
	/*Table Departements*/
	$sql2 = 'SELECT * from DEPARTMENTS where DEPTID= '.$row1['DEFAULTDEPTID'].'';
	foreach  ($db->query($sql2) as $row2) {
/*
$sql = 'SELECT * from CHECKINOUT where Mid(`CHECKTIME`,7,4) = '.$year.' and Mid (`CHECKTIME`,4,2) ='.$month.' and Mid (`CHECKTIME`,1,2) ='.$day.'';
*/
	
				
		echo "<tr>
		
	<td><div id='date".$id."'>".$row2['DEPTNAME']."</div></td>
	<td><div id='time".$id."'>".$row1['Name']."</div></td>
	<td><div id='date".$id."'>".$row1['Badgenumber']."</div></td>
	<td><div id='time".$id."'>".$row['CHECKTIME']."</div></td>
	
	</tr>";	
	 
	   
	   
	  
	   $id++;
	    $j++; 
	
	}}}
		?>
		   </tbody>
        </table> 
  </div>
		<br>
		
   <?php include ("footer.php"); ?>