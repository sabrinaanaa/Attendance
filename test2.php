<?php
$page = $_SERVER['PHP_SELF'];
$sec = "999";


  

$today = date('d/m/y',time());

$year = "20".substr($today,6,2);
$month = substr($today,3,2);
$monthlast = substr($today,3,2)-1;
$day = substr($today,0,2);




if ($day == 1){
    $yesterday = 30;}
  else {
  $yesterday = substr($today,0,2)-1;
  }
  
 



$filename= $day.$month.$year;




$dbName = "C:\\xampp\\htdocs\\Attendance\\att2000.mdb";
if (!file_exists($dbName)) {
    die("Could not find database file.");
}
$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=$dbName; Uid=; Pwd=;");
$yeartotext=strval($year);




$sql = 'SELECT *
FROM ((CHECKINOUT AS C LEFT JOIN USERINFO AS U ON C.USERID =U.USERID) LEFT JOIN DEPARTMENTS AS D ON U.DEFAULTDEPTID = D.DEPTID)
where (Mid(`CHECKTIME`,7,4) = '.$year.' and Mid (`CHECKTIME`,4,2) ='.$month.'  or Mid (`CHECKTIME`,4,2) ='.$monthlast.')
 
' ;







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
 
/* My Variables */

$id=0;
$liste_employee = array("3175", "6001", "2032", "1564","6509","6226","6317","1932","1597","1995","6368");
$result= [];	
$i=0;
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
	 

<h2>Last 2 Days</h2>
      <div class="table-responsive" id="PRT99">
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

   foreach  ($db->query($sql) as $row) 
   {
   	if(substr($row['CHECKTIME'],8,2) == $day && substr($row['CHECKTIME'],5,2) == $month || substr($row['CHECKTIME'],8,2) == $yesterday)
	   {
		if (in_array($row['Badgenumber'],$liste_employee))
		{
		/*
		$result[]=$row;
		*/
		$result[$i][0]=$row['DEPTNAME'];	
		$result[$i][1]=$row['Badgenumber'];	
		$result[$i][2]=$row['Name'];
		$result[$i][3]=$row['CHECKTIME'];
		$i++;
		}
		}
	   }
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
			
			{
				
	}
	/*Table employee
	$sql1 = 'SELECT * from USERINFO where USERID= '.$row['USERID'].'';
	foreach  ($db->query($sql1) as $row1) {*/
	/*Table Departements
	$sql2 = 'SELECT * from DEPARTMENTS where DEPTID= '.$row1['DEFAULTDEPTID'].' ORDER by DEPTID';
	foreach  ($db->query($sql2) as $row2) {
	*/
	
	function cmp($a, $b)
{
if ($a[0] == $b[0]) {
        return strcmp($a[2], $b[2]);
		/* Verify this */
		if ($a[2] == $b[2]) {
        return $b[3] - $a[3];
    }
	/*end of verif*/
    }

    return strcmp($a[0], $b[0]);
}

/*
	function cmp2($a, $b)
{
    return strcmp($a[2], $b[2]);
}
usort($result, "cmp2");
*/





usort($result, "cmp");





		/* Affichage Test

			$k=0;
			$r=0;
			$day0;
			$day1;
			$in0=0;
			$out=0;
			$in1=0;
			$time = [];


			for($r=0;$r<$i;$r++)
		{
		$bgcolor = $j % 2 === 0 ? "#DCDCDC" : "#A9A9A9";

		if($result[$r][0] == "Cuisine"){
		if ($result[$r][2] == "Nouri Ibrahim")
		{$in0=$result[$r][3];
		if($result[$r+1][3] < $in0){$in0=$result[$r+1][3];}
		}
		}
		
		echo "<tr><td><div id='Department".$id."'>".$result[$r][0]."</div></td>
		<td><div id='UserName".$id."'>".$result[$r][2]."</div></td>
		<td><div id='UserMat".$id."'>".$result[$r][1]."</div></td>";
		
		
		$day0 = substr($result[$r][3],8,2);
		$k = $r+1;
		$day1 = substr($result[$k][3],8,2);
		if($day0 > $day1){$day0 = $day1;}

echo "
	<td><div id='time".$id."'>".$result[$r][3]."</div></td>
		</tr>";


		$id++;
		$j++;
		}
		
		*/

				/* Affichage Working*/

			
			;
			


			for($r=0;$r<$i;$r++)
		{
		$bgcolor = $j % 2 === 0 ? "#DCDCDC" : "#A9A9A9";

				
		echo "<tr><td><div id='Department".$id."'>".$result[$r][0]."</div></td>
		<td><div id='UserName".$id."'>".$result[$r][2]."</div></td>
		<td><div id='UserMat".$id."'>".$result[$r][1]."</div></td>
		<td><div id='time".$id."'>".$result[$r][3]."</div></td>
		</tr>";


		$id++;
		$j++;
		}
		

		

	/*	echo "<tr><td><div id='date".$id."'>".$row['DEPTNAME']."</div></td>
		<td><div id='time".$id."'>".$row['Name']."</div></td>
		<td><div id='date".$id."'>".$row['Badgenumber']."</div></td>
	<td><div id='time".$id."'>".$row['CHECKTIME']."</div></td>
		</tr>";	
		

	<td><div id='date".$id."'>".$row['DEPTNAME']."</div></td>
	 <td><div id='time".$id."'>".$row['Name']."</div></td> 
	<td><div id='date".$id."'>".$row['Badgenumber']."</div></td>
	<td><div id='time".$id."'>".$row['CHECKTIME']."</div></td>
	
	*/

	
/*
$sql = 'SELECT * from CHECKINOUT where Mid(`CHECKTIME`,7,4) = '.$year.' and Mid (`CHECKTIME`,4,2) ='.$month.' and Mid (`CHECKTIME`,1,2) ='.$day.'';
*/
	
				
		
	 
	   
	   
	  
	    
	
	
	
		?>
		   </tbody>
        </table> 
  </div>
		<br>
		
   <?php include ("footer.php"); ?>