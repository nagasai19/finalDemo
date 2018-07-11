<?php
session_start();     
include 'logDbInc.php';
    
   
   if(!isset($_SESSION['uid'])){
  header("Location: index.php?invalidPage");
                        exit;
}        
   $k="";     
  $a =   array();
  $color = array();
  $color[0]="39a";
  $color[1]= "FF9800";
  $color[2]= "BBDEFB";
  $color[3]= "E040FB";
  $color[4]= "F50057";
  $color[5]= "B71C1C";
  $color[6]= "80CBC4";
  $color[7]= "1DE9B6";
  $color[8]= "43A047";
  $color[9]= "76FF03";
  $color[10]= "CDDC39";
  $color[11]= "EEFF41";
  $color[12]= "FFEB3B";



  if($_SESSION['person']=="admin"){
    $sqlPlant = "SELECT  plant FROM info ";
   $sqlp = mysqli_query($conn,$sqlPlant);
   while($rowp = mysqli_fetch_assoc($sqlp)){
              $k = $k.$rowp['plant']."&";
            } 
  } 
   
   else{
    //$sqlClient = "SELECT plants from clientLogIn where uid = '".$_SESSION['uid']."'";
    

  $sqlPlant = "SELECT plants from clientLogIn where uid = '".$_SESSION['uid']."'";
  $resultPlant = mysqli_query($conn, $sqlPlant);
  $fetch = mysqli_fetch_assoc($resultPlant);
  $k = $fetch['plants'];
   }
 
  //echo $k."hye";
  $k = explode("&", $k);
  
  for($i=0;$i<count($k)-1;$i++){
    //echo $k[$i]."hye";
   array_push($a,array($k[$i]));

  }

  //for ($i=0; $i <count($a) ; $i++) { 
    # code...
    //echo $a[$i][0]." hye<br/>";
//} 
  $sqlDate = "SELECT  dat FROM ".$a[1][0]."MTD 
  ORDER BY dat DESC LIMIT 0,1";
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
    $label="";
    $lab="";
    $estMTD="";
    $expMTD="";
    $estDSG="";
    $expDSG="";
    $estCTD="";
    $expCTD="";
    $l ="";
            
     if(isset($_POST['value'])){ 
      echo count($a)."/";
    }

    for ($i=0; $i <count($a) ; $i++){
      
      //for CTD plant avail
    $datemon = "SELECT  dat FROM ".$a[0][0]."MTD 
  ORDER BY dat ASC LIMIT 0,1";
  $Dateresult = mysqli_query($conn, $datemon);
  $rowDate = mysqli_fetch_assoc($Dateresult);

  $monthly = $rowDate['dat'];
  $monthly = date("Y-m-d",strtotime("-1 month",strtotime($monthly)));
$dateCheck = date("Y-m-t",strtotime("-1 month",strtotime($date)));
$final= "";

//end
      $a[$i][9]=',';
      $a[$i][10]=',';

while(!($final==$dateCheck))
{
  $tie = strtotime($monthly);
$final = date("Y-m-t", strtotime("+1 month", $tie));
$monthly = date("Y-m-d", strtotime("+1 month", $tie));
//echo $day."<br/>";
 
//echo $final."<br/>" ;
$a[$i][10]=$a[$i][10]."'".$final."'".",";
$sqlmonthly = "SELECT *  FROM  ".$a[$i][0]."MTD  where dat = '$final' ";
$resultmonthly = mysqli_query($conn, $sqlmonthly);

if($rowmonthly = mysqli_fetch_assoc($resultmonthly))
{
  
  $a[$i][9] = $a[$i][9].$rowmonthly["plantAvail"].',';
//echo $rowmonthly["plantAvail"]."<br/>";
//echo $a[6]."<br/>";
}
else{
  $a[$i][9] = $a[$i][9].'0'.',';
}
}

    //DSG
      $sqlDSG = "SELECT *  FROM  ".$a[$i][0]."  where dat = '$date' ";
    $resultDSG = mysqli_query($conn, $sqlDSG);
    while(  $rowDSG = mysqli_fetch_assoc($resultDSG)){
    $a[$i][1] = $rowDSG["dayExport"];
  }
     //MTD  
    $sqlMTD = "SELECT *  FROM  ".$a[$i][0]."MTD  where dat = '$date' ";
    $resultMTD = mysqli_query($conn, $sqlMTD);
    while(  $rowMTD = mysqli_fetch_assoc($resultMTD)){
    $a[$i][2] = $rowMTD["export"];
    $a[$i][8] = $rowMTD["plantAvail"];
  } 
 //CTD
  $sqlCTD = "SELECT *  FROM  ".$a[$i][0]."CTD  where dat = '$date' ";
    $resultCTD = mysqli_query($conn, $sqlCTD);
    while(  $rowCTD = mysqli_fetch_assoc($resultCTD)){
    $a[$i][3] = $rowCTD["export"];
  }
    //estimated MTD and DSG
  $resEstimated = mysqli_query($conn,"SELECT * FROM ".$a[$i][0]."Estimated where date between '$year-$month-01' and '$year-$month-31'");
 while( $rowEstimated = mysqli_fetch_assoc($resEstimated)){
  $a[$i][4] = $rowEstimated['export'];
  $a[$i][5] = $rowEstimated['export']*$day;
 }
//estimated CTD

    $a[$i][6] = 0;
  $mth = $month-1;
  $resEsti = mysqli_query($conn,"SELECT *    FROM ".$a[$i][0]."Estimated where date between '2017-08-01' and '$year-$mth-31'");
  //echo "SELECT *    FROM ".$_SESSION['id']."Estimated where date between '2017-08-01' and '$year-0$mth-31'";
  while($rowEsti = mysqli_fetch_assoc($resEsti)){
    $a[$i][7] = $rowEsti['date'];
   // echo $f[0];
    $t = strtotime($a[$i][7]);
    $m = date("m",$t);
    $y = date("Y",$t);
    
    $a[$i][6] += $rowEsti['export']*cal_days_in_month(CAL_GREGORIAN,$m,$y);
   
  }
  $a[$i][6] += $a[$i][5];

  if(cal_days_in_month(CAL_GREGORIAN,$month,$year)!=$day)
{
  $a[$i][9] = $a[$i][9].$a[$i][8];
  $a[$i][10]= $a[$i][10]."'".$date."'";
} 
  
  $a[$i][9] = trim($a[$i][9],",");
  $a[$i][10] = trim($a[$i][10],",");

     if(isset($_POST['value']))
     {  
      echo $a[$i][9]."/";
    }
    
   //echo $a[0][1]." ,".;
 $label=$label.'"'.$a[$i][0].'"'.',';
 $lab=$lab.$a[$i][0].',';
 $estMTD=$estMTD.$a[$i][5].',';
 $expMTD=$expMTD.$a[$i][2].',';
 $estDSG=$estDSG.$a[$i][4].',';
 $expDSG=$expDSG.$a[$i][1].',';
 $estCTD=$estCTD.$a[$i][6].',';
 $expCTD=$expCTD.$a[$i][3].',';
 $l = $l.",{ data: [" .$a[$i][9] ."],backgroundColor: 'transparent',borderColor: '#".$color[$i]."',borderWidth: 5,label: '".$a[$i][0]."'}";
}
//echo $a[0][10]."/";
$l = trim($l,",");
    $label=trim($label,",");
    $lab=trim($lab,",");
    $estMTD=trim($estMTD,",");
    $expMTD=trim($expMTD,",");
    $estDSG=trim($estDSG,",");
    $expDSG=trim($expDSG,","); 
    $estCTD=trim($estCTD,",");
    $expCTD=trim($expCTD,",");   

    if(isset($_POST['value'])){        
      echo $a[0][10]."/".$lab."/".$estMTD."/".$expMTD."/".$estDSG."/".$expDSG."/".$estCTD."/".$expCTD;
    }  
  //SELECT parigiMTD.* , parigiCTD.* FROM parigiMTD INNER JOIN parigiCTD ON parigiMTD.dat = parigiCTD.dat where parigiMTD.dat = '2018-06-11' 
          ?>  

