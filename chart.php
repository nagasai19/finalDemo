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
$a =   array();
$chk;
    $sqlDate = "SELECT  dat FROM ".$_SESSION['id']." 
  ORDER BY dat DESC LIMIT 0,1";
  //echo $sqlDate;
  $resultDate = mysqli_query($conn, $sqlDate);
  $rowDate = mysqli_fetch_assoc($resultDate);

  $date = $rowDate['dat'];
  if(empty($date)){
     $chk = 0 ;
     //header("Location: plantgraph.php?dataEmpty");
                        //exit;
  }
  else
  {
    $chk = 1;
    if(isset($_POST['value'])){
$date =  $_POST["value"];
    
  }
  //for CTD plant avail
  $datemon = "SELECT  dat FROM ".$_SESSION['id']."MTD 
  ORDER BY dat ASC LIMIT 0,1";
  $Dateresult = mysqli_query($conn, $datemon);
  $rowDate = mysqli_fetch_assoc($Dateresult);

  $monthly = $rowDate['dat'];
  $monthly = date("Y-m-d",strtotime("-1 month",strtotime($monthly)));
$dateCheck = date("Y-m-t",strtotime("-1 month",strtotime($date)));
$final= "";
$a[6]=',';
$a[7]=',';

 while(!($final==$dateCheck))
{
  $tie = strtotime($monthly);
$final = date("Y-m-t", strtotime("+1 month", $tie));
$monthly = date("Y-m-d", strtotime("+1 month", $tie));
//echo $day."<br/>";
 
//echo $final."<br/>" ;
$a[7]=$a[7]."'".$final."'".",";
$sqlmonthly = "SELECT *  FROM  ".$_SESSION['id']."MTD  where dat = '$final' ";
$resultmonthly = mysqli_query($conn, $sqlmonthly);
while($rowmonthly = mysqli_fetch_assoc($resultmonthly))
{
  
  $a[6] = $a[6].$rowmonthly["plantAvail"].',';
//echo $rowmonthly["plantAvail"]."<br/>";
//echo $a[6]."<br/>";
}
}

    //echo  $sqlMTD;
    
  
 // echo $a[6]."<br/>";
  //echo $a[7];

//end
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
  $dc ="";
  $ac ="";
  $mt ="";
  $ga ="";
  $co ="";
  
    
 
     $sqlTable = "SELECT  * FROM ".$_SESSION['id']." 
 where dat = '$date'" ;
    
$queryTable = mysqli_query($conn, $sqlTable);
 while ($row = mysqli_fetch_assoc($queryTable))
    {
      $dc = $row['dcCUF'];
      $ac = $row['acCUF'];
      $mt = $row['moduleTemp'];
      $ga = $row['generationAvail'];
      if(empty($row['comments']))
      {
        $co = " ";
        
      }
      else {
        $co = $row['comments'];
      }
    }
    
  
  // Splitting date
  $time = strtotime($date);
    $day = date("d",$time);
    $month = date("m",$time);
    $year = date("Y",$time);
    
  $dates ="";
  $ener="";
  $sol="";
  $expenses="";
  $revenues="";
  $comm ="";
  $expo ="";
  $estiExpo="";
  $estiPR="";
  $PR ="";
  $gridPR = "";
  $label="";
  $est="";
  $exp="";
    
  //monthly data
   $sqlMTD = "SELECT *  FROM  ".$_SESSION['id']."MTD  where dat = '$date' ";
    //echo  $sqlMTD;
    $resultMTD = mysqli_query($conn, $sqlMTD);
    while(  $rowMTD = mysqli_fetch_assoc($resultMTD))

      {$a[2] = $rowMTD["export"];
    $a[5] = $rowMTD["plantAvail"];
  }
  //yearly data
    $sqlCTD = "SELECT *  FROM  ".$_SESSION['id']."CTD  where dat = '$date' ";
    //echo  $sqlMTD;
    $resultCTD = mysqli_query($conn, $sqlCTD);
    while(  $rowCTD = mysqli_fetch_assoc($resultCTD))
      {$a[4] = $rowCTD["export"];}



 // Estimated data
  $resEstimated = mysqli_query($conn,"SELECT * FROM ".$_SESSION['id']."Estimated where date between '$year-$month-01' and '$year-$month-31'");
  $rowEstimated = mysqli_fetch_assoc($resEstimated);
  $estiExport = $rowEstimated['export'];
  $a[1] = $rowEstimated['export'];
  $a[3] = $rowEstimated['export']*$day;
  $estiInsolation = $rowEstimated['insolation'];
  $base = $rowEstimated['baseCUF'] ;
  $basePR = $rowEstimated['basePR'];
  $tr = $dc.','.$ac.','.$base.','.$mt.','.$ga.','.$co; 
  //estimated CTD
  for($i=0;$i<3;$i++)
    $f[$i] = 0;
  $mth = $month-1;
  $resEsti = mysqli_query($conn,"SELECT *    FROM ".$_SESSION['id']."Estimated where date between '2017-08-01' and '$year-$mth-31'");
  //echo "SELECT *    FROM ".$_SESSION['id']."Estimated where date between '2017-08-01' and '$year-0$mth-31'";
  while($rowEsti = mysqli_fetch_assoc($resEsti))
  {
    $f[0] = $rowEsti['date'];
   // echo $f[0];
    $t = strtotime($f[0]);
    $m = date("m",$t);
    $y = date("Y",$t);
    
    $f[1] += $rowEsti['export']*cal_days_in_month(CAL_GREGORIAN,$m,$y);
   
  }
  $f[1] += $a[3];
  
  
         
//  Daily data
  $query = "SELECT * FROM ".$_SESSION['id']." where dat between '$year-$month-01'and '$year-$month-$day'";
  $result = mysqli_query($conn, $query);
  
while($row = mysqli_fetch_assoc($result))
{

 $dat = $row["dat"];
  $t = strtotime($dat);
    $d = date("j",$t);
 $gridAvail = $row["gridAvail"];
 $plantAvail = $row["plantAvail"];
 $exp = $row["dayExport"];
 $a[0] = $row["dayExport"];
 $p = $row["PR"];
 $gp = $row["gridCorrectedPR"];
 $energy = ($row["dayExport"]/$estiExport)*100;
 $solar = ($row["dayInsolation"]/$estiInsolation)*100;
 $comments = "";
 if(empty($row['comments']))
      {
        $comments = " ";
        
      }
      else {
        $comments = $row["comments"];
      }
 
 $estiExpo = $estiExpo.$estiExport.',';
 
 $estiPR = $estiPR.$basePR.',';
  $dates = $dates.$d.',';
  $expenses = $expenses.$gridAvail.',';
  $ener = $ener.$energy.',';
  $sol = $sol.$solar.',';
  $expo = $expo.$exp.',';
  $PR = $PR.$p.',';
  $gridPR = $gridPR.$gp.',';
  $revenues = $revenues.$plantAvail.',';
  $comm = $comm.$comments.',';
}
// making array
//echo $m.$y.cal_days_in_month(CAL_GREGORIAN,$month,$year).$d;
if(cal_days_in_month(CAL_GREGORIAN,$month,$year)!=$d)
{
  $a[6] = $a[6].$a[5];
  $a[7]= $a[7]."'".$date."'";
} 
  
  $a[6] = trim($a[6],",");
  $a[7] = trim($a[7],",");
$dates = trim($dates, ",");
$expenses = trim($expenses, ",");
$revenues = trim($revenues, ",");
$comm = trim($comm, ",");
$ener = trim($ener, ",");
$sol = trim($sol, ","); 
$expo = trim($expo, ",");
$PR = trim($PR, ",");
$gridPR = trim($gridPR, ",");
$estiExpo =  trim($estiExpo, ",");
$estiPR = trim($estiPR,",");
$tr = trim($tr,",");
$label='"'.$_SESSION['id'].'"';
$lab=$_SESSION['id'];
//echo array_values($a);
//echo $f[1];
if(isset($_POST['value'])){
  echo $dates.'/'.$expenses.'/'.$revenues.'/'.$ener.'/'.$sol.'/'.$expo.'/'.$estiExpo.'/'.$PR.'/'.$gridPR.'/'.$estiPR.'/'.$lab.'/'.$a[0].'/'.$a[1].'/'.$a[2].'/'.$a[3].'/'.$a[4].'/'.$f[1].'/'.$a[6].'/'.$a[7].'/'.$tr;
}}
    

  


          ?>



