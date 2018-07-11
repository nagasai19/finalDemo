<?php
session_start(); 
    include 'logDbInc.php';
    
if ((empty($_SESSION['id'])&&empty($_SESSION['uid'])))
   {
   header("Location: index.php?loginfirst");
    exit;
    }
$a =   array();
$sqlDate = "SELECT  dat FROM ".$_SESSION['id']."MTD ORDER BY dat DESC LIMIT 0,1";
$resultDate = mysqli_query($conn, $sqlDate);
  $rowDate = mysqli_fetch_assoc($resultDate);

  $date = $rowDate['dat'];

if(isset($_POST['value'])){
$date =  $_POST["value"];
 }
    $time = strtotime($date);
    $day = date("d",$time);
    $month = date("m",$time);
    $year = date("Y",$time);
    $mth = $month-1;
    //Estimated data
    $resEstimated = mysqli_query($conn,"SELECT * FROM ".$_SESSION['id']."Estimated where date between '$year-$month-01' and '$year-$month-31'");
    while ($rowEstimated = mysqli_fetch_assoc($resEstimated)) {
    	# code...
    	$a[0] = $rowEstimated['module'];
    	$a[1] = $rowEstimated['module']*$day;
    	//echo $a[0];
    }
    //Estimated CTD
    for($i=2;$i<=6;$i++)
    $a[$i] = "";
    $resEsti = mysqli_query($conn,"SELECT *    FROM ".$_SESSION['id']."Estimated where date between '2018-01-01' and '$year-$mth-31'");
    while($rowEsti = mysqli_fetch_assoc($resEsti)){
    	$p = $rowEsti['date'];
   
    $t = strtotime($p);
    $m = date("m",$t);
    $y = date("Y",$t);
    
    $a[2] += $rowEsti['module']*cal_days_in_month(CAL_GREGORIAN,$m,$y);
    }
    $a[2] += $a[1];
    switch ($_SESSION['id']) {
      case 'parigi': $a[2] +=6006;
        # code...
        break;
      case 'kothagadi': $a[2] +=3520;
        # code...
        break;
      case 'peerampalle': $a[2] +=4420;
        # code...
        break;  
      default:
        # code...
        break;
    }
    $query = "SELECT * FROM ".$_SESSION['id']."MTD where dat between '$year-$month-01'and '$year-$month-$day'";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result))
  {
  	$dat = $row["dat"];
    $t = strtotime($dat);
    $d = date("j",$t);
    $a[3] = $row["module"];
    $a[4] = $a[4].$row["module"].',';
    $a[5] = $a[5].$a[0]*$d.',';
    $a[6] = $a[6].$d.',';
    
  }
  $sqlCTD = "SELECT *  FROM  ".$_SESSION['id'].       "CTD  where dat = '$date' ";
    $resultCTD = mysqli_query($conn, $sqlCTD);
    while(  $rowCTD = mysqli_fetch_assoc($resultCTD)){
    	$a[7] = $rowCTD["module"];
    }
    $sqlDSG = "SELECT *  FROM  ".$_SESSION['id'].       "  where dat = '$date' ";
    $resultDSG = mysqli_query($conn, $sqlDSG);
    while(  $rowDSG = mysqli_fetch_assoc($resultDSG)){
    	$a[8] = $rowDSG["status"];
    }
  for($i=4;$i<=6;$i++){
  	$a[$i] = trim($a[$i],",");
  }
  $a[9] = round(100*($a[3]-$a[1])/$a[1],2) ;
  $a[10] = round(100*($a[7]-$a[2])/$a[2],2) ;

  	//echo $a[4];
  //echo $a[4];
  	if(isset($_POST['value'])){
  		echo $a[4].'&'.$a[5].'&'.$a[6].'&'.$a[3].'&'.$a[1].'&'.$a[9].'&'.$a[7].'&'.$a[2].'&'.$a[10].'&'.$a[8];
  	}

?>
