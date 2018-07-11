<?php
session_start();
include 'logDbInc.php';
if (isset($_POST["plant"])){
   $id=$_POST["plant"];
   $_SESSION['id'] = $id;
}
 
 if ((empty($_SESSION['id'])&&empty($_SESSION['uid']))){
   header("Location: index.php?loginfirst");
                        exit;
}  
//Fetching for Default Value
    $sqlDate = "SELECT  dat FROM ".$_SESSION['id']." 
  ORDER BY dat DESC LIMIT 0,1";
  $resultDate = mysqli_query($conn, $sqlDate);
  $rowDate = mysqli_fetch_assoc($resultDate);

  $date = $rowDate['dat'];
if(isset($_POST['value'])){
$date =  $_POST["value"];
 }

  // Splitting date
    $time = strtotime($date);
    $day = date("d",$time);
    $month = date("m",$time);
    $year = date("Y",$time);
    $a = array();
    $b = array();
    $c = array();
    $d = array();
    $e = array();
    $f = array();
    $sqlPlant = "SELECT  * FROM info where plant = '".$_SESSION['id']."'" ;
    //echo $sqlPlant;
    $resultPlant = mysqli_query($conn, $sqlPlant);
    $e = array();
  while($fetch = mysqli_fetch_assoc($resultPlant)){
   $e[0] = $fetch['DCcapacity'];
   $e[1] = $fetch['ACcapacity'];
   $e[2] = $fetch['inverters'];
   $e[3] = $fetch['client'];
  } 
  
    
   // For Displaying Table
     $sqlTable = "SELECT  * FROM ".$_SESSION['id']        ." where dat = '$date'" ;
    
 $queryTable = mysqli_query($conn, $sqlTable);
 while ($row = mysqli_fetch_assoc($queryTable))
    {   
      $a[0] = $row['dayExport'];
      $a[1] = $row['dayInsolation'];
      $a[2] = $row['moduleTemp'];
      $a[3] = $row['dcCUF'];
      $a[4] = $row['acCUF'];
      $a[5] = $row["PR"];
        $a[6] = $row["gridCorrectedPR"];
        $a[7] = $row["plantAvail"];
      $a[8] = $row["gridAvail"];        
      $a[9] = $row['generationAvail'];
      
      if(empty($row['comments']))
      {
        $a[10] = " ";
        
      }
      else {
        $a[10] = $row['comments'];
      }
    }   
  $dates ="";  
  //monthly data
    $sqlMTD = "SELECT *  FROM  ".$_SESSION['id'].       "MTD  where dat = '$date' ";
    $resultMTD = mysqli_query($conn, $sqlMTD);
    while(  $rowMTD = mysqli_fetch_assoc($resultMTD))
    {
      $b[0] = $rowMTD["export"];
      $b[1] = $rowMTD["insolation"];
      $b[2] = $rowMTD["temp"];
      $b[3] = $rowMTD["dcCUF"];
      $b[4] = $rowMTD["acCUF"];
      $b[5] = $rowMTD["PR"];
      $b[6] = $rowMTD["gridCorrectedPR"];
      $b[7] = $rowMTD["plantAvail"];
      $b[8] = $rowMTD["gridAvail"];
      $b[9] = $rowMTD["generationAvail"];
    }
 //yearly data
   $sqlCTD = "SELECT *  FROM  ".$_SESSION['id'].       "CTD  where dat = '$date' ";
    $resultCTD = mysqli_query($conn, $sqlCTD);
    while(  $rowCTD = mysqli_fetch_assoc($resultCTD))
    {
      $c[0] = $rowCTD["export"];
      $c[1] = $rowCTD["insolation"];
      $c[2] = $rowCTD["temp"];
      $c[3] = $rowCTD["dcCUF"];
      $c[4] = $rowCTD["acCUF"];
      $c[5] = $rowCTD["PR"];
      $c[6] = $rowCTD["gridCorrectedPR"];
      $c[7] = $rowCTD["plantAvail"];
      $c[8] = $rowCTD["gridAvail"];
      $c[9] = $rowCTD["generationAvail"];
    }
 // Estimated data
  $resEstimated = mysqli_query($conn,"SELECT *    FROM ".$_SESSION['id']."Estimated where date between '$year-$month-01' and '$year-$month-31'");
  while($rowEstimated = mysqli_fetch_assoc($resEstimated)){
    $d[0] = $rowEstimated['export'];
    $d[1] = $rowEstimated['insolation'];
    $d[2] = round($rowEstimated['baseCUF'],2);
    $d[3] = round($rowEstimated['basePR'],2);
    $d[4] = $rowEstimated['export']*$day;
    $d[5] = $rowEstimated['insolation']*$day;
  }
  for($i=0;$i<8;$i++)
    $f[$i] = 0;
  $mth = $month-1;
  $resEsti = mysqli_query($conn,"SELECT *    FROM ".$_SESSION['id']."Estimated where date between '2017-08-01' and '$year-$mth-31'");
  //echo "SELECT *    FROM ".$_SESSION['id']."Estimated where date between '2017-08-01' and '$year-0$mth-31'";
  while($rowEsti = mysqli_fetch_assoc($resEsti)){
    $f[0] = $rowEsti['date'];
   // echo $f[0];
    $t = strtotime($f[0]);
    $m = date("m",$t);
    $y = date("Y",$t);
    $f[5] += cal_days_in_month(CAL_GREGORIAN,$m,$y);
    $f[1] += $rowEsti['export']*cal_days_in_month(CAL_GREGORIAN,$m,$y);
    $f[2] += $rowEsti['insolation']*cal_days_in_month(CAL_GREGORIAN,$m,$y);
  }
  $f[1] += $d[4];
  $f[2] += $d[5];
  $f[5] += $day;
  $f[3] = round(100*$f[1]/(24*$e[1]*$f[5]),2);
  $f[4] = round(100*$f[1]/($f[2]*$e[0]),2);

           

//echo array_values($a);
 // echo $a[10];
if(isset($_POST['value'])){
  echo $date.'&'.$a[0].'&'.$a[1].'&'.$a[2].'&'.$a[3].'&'.$a[4].'&'.$a[5].'&'.$a[6].'&'.$a[7].'&'.$a[8].'&'.$a[9].'&'.$b[0].'&'.$b[1].'&'.$b[2].'&'.$b[3].'&'.$b[4].'&'.$b[5].'&'.$b[6].'&'.$b[7].'&'.$b[8].'&'.$b[9].'&'.$c[0].'&'.$c[1].'&'.$c[2].'&'.$c[3].'&'.$c[4].'&'.$c[5].'&'.$c[6].'&'.$c[7].'&'.$c[8].'&'.$c[9].'&'.$d[0].'&'.$d[1].'&'.$d[2].'&'.$d[3].'&'.$d[4].'&'.$d[5].'&'.$f[1].'&'.$f[2].'&'.$f[3].'&'.$f[4].'&'.$a[10];
}

          ?>



