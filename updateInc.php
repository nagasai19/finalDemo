<?php
session_start();
include 'logDbInc.php';
if(isset($_POST["admin"])){
    //fetching plant info
$sql = "SELECT * FROM info WHERE plant = '".$_SESSION['id']."'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

    $date = mysqli_real_escape_string($conn,$_SESSION['Date']) ;
    $DCcapacity = $row['DCcapacity'] ;
    $ACcapacity = $row['ACcapacity'] ;
    $noInverter = $row['inverters'] ;
    $noSCB = $row['SCB'] ;
    $noStr = $row['strings'] ;
   //fetching form value
    $export = mysqli_real_escape_string($conn,$_POST["dayExport"]) ;
    $insolation = mysqli_real_escape_string($conn,$_POST["dayInsolation"]) ;
    $sunRise = mysqli_real_escape_string($conn,$_POST["rise"]) ;
    $sunSet = mysqli_real_escape_string($conn,$_POST["set"]) ;
    $temp = mysqli_real_escape_string($conn,$_POST["moduleTemp"]);
    $bdInverter =mysqli_real_escape_string($conn,$_POST["bdInverter"]);
    $bdGrid =mysqli_real_escape_string($conn,$_POST["bdGrid"]);
    $bdSCB =mysqli_real_escape_string($conn,$_POST["bdSCB"]);
    $bdStr =mysqli_real_escape_string($conn,$_POST["bdStr"]);
    $corr =mysqli_real_escape_string($conn,$_POST["corr"]);
    $module =mysqli_real_escape_string($conn,$_POST["module"]);
    $status =mysqli_real_escape_string($conn,$_POST["status"]);
    $comment =mysqli_real_escape_string($conn,$_POST["comments"]);
    //splitting time
    $glodate = $date;
    $time = strtotime($date);
    $day = date("d",$time);
    $month = date("m",$time);
    $year = date("Y",$time);
//function for converting time to integer
    function decimalHours($time)
{
    $hms = explode(":", $time);
    return ($hms[0]+($hms[1]/60)   );
}
  //formulas
 $sunAva= decimalHours($sunSet)-decimalHours($sunRise);
 $IA = 1-(decimalHours($bdInverter)/($noInverter*$sunAva));
 $ScbA = 1- (decimalHours($bdSCB)/($noSCB*$sunAva));
 $strA = 1-(decimalHours($bdStr)/($noStr*$sunAva));
 $gridA = 100*(1-(decimalHours($bdGrid)/$sunAva));
 $plantA =100*( 1-((1-$IA)+(1-$ScbA)+(1-$strA)));
 $GenerationA = 100*(1-(1-($plantA/100)+1-($gridA/100)));
 $DC_CUF = 100*($export/(24*$DCcapacity));
 $AC_CUF =100*( $export/(24*$ACcapacity));
 $PR = 100*($export/($insolation*$DCcapacity));
 $gridCorrectedPR = 100*($export/($corr*$DCcapacity)); 
 /*   
$date = strtotime("+1 day", strtotime("$date"));
$date = date("Y-m-d", $date);
echo $date;*/

 //update
   if($_SESSION['operation']=="update"){
 $sql_update ="update ".$_SESSION['id']."
                        set dat = '$date', sunAvail = '$sunAva',dayExport ='$export',dayInsolation =' $insolation', dcCUF='$DC_CUF',acCUF = '$AC_CUF',moduleTemp = '$temp',gridAvail ='$gridA', plantAvail='$plantA',generationAvail='$GenerationA',PR='$PR',corrInsolation='$corr',gridCorrectedPR = '$gridCorrectedPR',module = '$module',status = '$status', comments ='$comment' where dat = '$date'";
                             

        mysqli_query($conn,$sql_update);
    //updating mtd
     do{
         //fetching monthly data
        $exportMTD = "select sum(dayExport),sum(dayInsolation),avg(dcCUF),avg(acCUF),avg(moduleTemp),avg(gridAvail),avg(plantAvail),avg(generationAvail),avg(PR),sum(corrInsolation),avg(gridCorrectedPR),sum(module) from ".$_SESSION['id']." where dat between '$year-$month-01'and '$date'" ;
       $resultMTD = mysqli_fetch_assoc( mysqli_query($conn,$exportMTD));
       //formulas for mtd
        $a = $resultMTD['sum(dayExport)'];
        $b = $resultMTD['sum(dayInsolation)'];
        $c = $resultMTD['avg(moduleTemp)'];
        $d = $resultMTD['avg(dcCUF)'];
        $e = $resultMTD['avg(acCUF)'];
        $f = 100*($a/($b*$DCcapacity));
        $g = $resultMTD['sum(corrInsolation)'];
        $h = 100*($a/($g*$DCcapacity));
        $i = $resultMTD['avg(plantAvail)'];
        $j = $resultMTD['avg(gridAvail)'];
        $k = $resultMTD['avg(generationAvail)'];
        $l = $resultMTD['sum(module)'];

        //updating mtd data
        $mtdUpdate = "update ".$_SESSION['id']."MTD set dat = '$date', export = '$a' , insolation = '$b',temp ='$c',dcCUF = '$d',acCUF = '$e' ,PR = '$f', corrInsolation = '$g', gridCorrectedPR = '$h',plantAvail='$i',gridAvail = '$j', generationAvail = '$k' , module = '$l' where dat = '$date'";
        mysqli_query($conn,$mtdUpdate);
         //adding successive date
        $dat = strtotime("+1 day", strtotime("$date"));
        $date = date("Y-m-d", $dat);
        $mon = date("m",$dat);
        $sqlmtd = " select * from ".$_SESSION['id']." where dat ='$date'";
        $resultchk = mysqli_query($conn,$sqlmtd);
        $result_check = mysqli_num_rows($resultchk);
        //checking month has been changed or not
        if($mon!=$month)
            {
              break;
            }                
        }while($result_check>=1);
        //updating ytd data
        $date = $glodate ;
        do{
         //fetching yearly data
        $exportYTD = "select sum(dayExport),sum(dayInsolation),avg(dcCUF),avg(acCUF),avg(moduleTemp),avg(gridAvail),avg(plantAvail),avg(generationAvail),avg(PR),sum(corrInsolation),avg(gridCorrectedPR),sum(module) from ".$_SESSION['id']." where dat between '$year-01-01'and '$date'" ;
       $resultYTD = mysqli_fetch_assoc( mysqli_query($conn,$exportYTD));
       //formulas for ytd
        $ay = $resultYTD['sum(dayExport)'];
        $by = $resultYTD['sum(dayInsolation)'];
        $cy = $resultYTD['avg(moduleTemp)'];
        $dy = $resultYTD['avg(dcCUF)'];
        $ey = $resultYTD['avg(acCUF)'];
        $fy = 100*($ay/($by*$DCcapacity));
        $gy = $resultYTD['sum(corrInsolation)'];
        $hy = 100*($ay/($gy*$DCcapacity));
        $iy = $resultYTD['avg(plantAvail)'];
        $jy = $resultYTD['avg(gridAvail)'];
        $ky = $resultYTD['avg(generationAvail)'];
        $ly = $resultYTD['sum(module)'];
        
        $ytdUpdate = "update ".$_SESSION['id']."YTD set dat = '$date', export = '$ay' , insolation = '$by',temp ='$cy',dcCUF = '$dy',acCUF = '$ey' ,PR = '$fy', corrInsolation = '$gy', gridCorrectedPR = '$hy',plantAvail='$iy',gridAvail = '$jy', generationAvail = '$ky' , module = '$ly' where dat = '$date'";
        mysqli_query($conn,$ytdUpdate);
         //adding successive date
        $dat = strtotime("+1 day", strtotime("$date"));
        $date = date("Y-m-d", $dat);
        $yr = date("Y",$dat);
        $sql = " select * from ".$_SESSION['id']." where dat ='$date'";
        $resultchk = mysqli_query($conn,$sql);
        $result_check = mysqli_num_rows($resultchk);
        
        if($yr!=$year)
            {
              break;
            }                
        }while($result_check>=1);
        
        $date = $glodate;
        do{
        
        $exportCTD = "select sum(dayExport),sum(dayInsolation),avg(dcCUF),avg(acCUF),avg(moduleTemp),avg(gridAvail),avg(plantAvail),avg(generationAvail),avg(PR),sum(corrInsolation),avg(gridCorrectedPR),sum(module) from ".$_SESSION['id']." where dat between '2017-08-01'and '$date'" ;
       $resultCTD = mysqli_fetch_assoc( mysqli_query($conn,$exportCTD));
       
        $ac = $resultCTD['sum(dayExport)'];
        $bc = $resultCTD['sum(dayInsolation)'];
        $cc = $resultCTD['avg(moduleTemp)'];
        $dc = $resultCTD['avg(dcCUF)'];
        $ec = $resultCTD['avg(acCUF)'];
        $fc = 100*($ac/($bc*$DCcapacity));
        $gc = $resultCTD['sum(corrInsolation)'];
        $hc = 100*($ac/($gc*$DCcapacity));
        $ic = $resultCTD['avg(plantAvail)'];
        $jc = $resultCTD['avg(gridAvail)'];
        $kc = $resultCTD['avg(generationAvail)'];
        $lc = $resultCTD['sum(module)'];
       
        $ctdUpdate = "update ".$_SESSION['id']."CTD set dat = '$date', export = '$ac' , insolation = '$bc',temp ='$cc',dcCUF = '$dc',acCUF = '$ec' ,PR = '$fc', corrInsolation = '$gc', gridCorrectedPR = '$hc',plantAvail='$ic',gridAvail = '$jc', generationAvail = '$kc', module = '$lc' where dat = '$date'";
        mysqli_query($conn,$ctdUpdate);
         
        $dat = strtotime("+1 day", strtotime("$date"));
        $date = date("Y-m-d", $dat);
       
        $sql = " select * from ".$_SESSION['id']." where dat ='$date'";
        $resultchk = mysqli_query($conn,$sql);
        $result_check = mysqli_num_rows($resultchk);
        
                      
        }while($result_check>=1);

        header("Location: plantgraph.php?updateData=success");
        exit();
        
   }
   //insert
    else{
        //insert data into database
            $sql_insert ="insert into ".$_SESSION['id']."(dat,sunAvail,dayExport,dayInsolation,dcCUF,acCUF,moduleTemp,gridAvail,plantAvail,generationAvail,PR,corrInsolation,gridCorrectedPR,module,status,comments) values ('$date','$sunAva','$export','$insolation','$DC_CUF','$AC_CUF','$temp','$gridA','$plantA','$GenerationA','$PR','$corr','$gridCorrectedPR','$module','$status','$comment')";
           // echo $sql_insert."<br/>";
           mysqli_query($conn,$sql_insert);
        //insert data in mtd
            //fetching previous values
            $exportMTD = "select sum(dayExport),sum(dayInsolation),avg(dcCUF),avg(acCUF),avg(moduleTemp),avg(gridAvail),avg(plantAvail),avg(generationAvail),avg(PR),sum(corrInsolation),avg(gridCorrectedPR),sum(module) from ".$_SESSION['id']." where dat between '$year-$month-01'and '$date'" ;
            //echo $exportMTD."<br/>";
            $resultMTD = mysqli_fetch_assoc( mysqli_query($conn,$exportMTD));
            //fuctions mtd
            $a = $resultMTD['sum(dayExport)'];
            $b = $resultMTD['sum(dayInsolation)'];
            echo $b."hye";
            $c = $resultMTD['avg(moduleTemp)'];
            $d = $resultMTD['avg(dcCUF)'];
            $e = $resultMTD['avg(acCUF)'];
            $f = 100*($a/($b*$DCcapacity));
            $g = $resultMTD['sum(corrInsolation)'];
            $h = 100*($a/($g*$DCcapacity));
            $i = $resultMTD['avg(plantAvail)'];
            $j = $resultMTD['avg(gridAvail)'];
            $k = $resultMTD['avg(generationAvail)'];
            $l = $resultMTD['sum(module)'];

            $insert_mtd = "insert into ".$_SESSION['id']."MTD (dat,export,insolation,temp,dcCUF,acCUF,PR,corrInsolation,gridCorrectedPR,plantAvail,gridAvail,generationAvail,module) values ('$date','$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l')"; 
            //echo $insert_mtd."<br/>";               
            mysqli_query($conn,$insert_mtd);
        //insert data in ytd
            //fetching previous values          
            $exportYTD = "select sum(dayExport),sum(dayInsolation),avg(dcCUF),avg(acCUF),avg(moduleTemp),avg(gridAvail),avg(plantAvail),avg(generationAvail),avg(PR),sum(corrInsolation),avg(gridCorrectedPR),sum(module) from ".$_SESSION['id']." where dat between '$year-01-01'and '$date'" ;
            $resultYTD = mysqli_fetch_assoc( mysqli_query($conn,$exportYTD));
            
            $ay = $resultYTD['sum(dayExport)'];
            $by = $resultYTD['sum(dayInsolation)'];
            $cy = $resultYTD['avg(moduleTemp)'];
            $dy = $resultYTD['avg(dcCUF)'];
            $ey = $resultYTD['avg(acCUF)'];
            $fy = 100*($ay/($by*$DCcapacity));
            $gy = $resultYTD['sum(corrInsolation)'];
            $hy = 100*($ay/($gy*$DCcapacity));
            $iy = $resultYTD['avg(plantAvail)'];
            $jy = $resultYTD['avg(gridAvail)'];
            $ky = $resultYTD['avg(generationAvail)'];
            $ly = $resultYTD['sum(module)'];
            $insert_ytd = "insert into ".$_SESSION['id']."YTD (dat,export,insolation,temp,dcCUF,acCUF,PR,corrInsolation,gridCorrectedPR,plantAvail,gridAvail,generationAvail,module) values ('$date','$ay','$by','$cy','$dy','$ey','$fy','$gy','$hy','$iy','$jy','$ky','$ly')";
            //echo $insert_ytd."<br/>";        
            mysqli_query($conn,$insert_ytd);  
            //insert data in ctd
            //fetching previous values          
            $exportCTD = "select sum(dayExport),sum(dayInsolation),avg(dcCUF),avg(acCUF),avg(moduleTemp),avg(gridAvail),avg(plantAvail),avg(generationAvail),avg(PR),sum(corrInsolation),avg(gridCorrectedPR),sum(module) from ".$_SESSION['id']." where dat between '2017-08-01'and '$date'" ;
            $resultCTD = mysqli_fetch_assoc( mysqli_query($conn,$exportCTD));
            //echo $exportCTD."<br/>";
            //fuctions ctd
            $ac = $resultCTD['sum(dayExport)'];
            $bc = $resultCTD['sum(dayInsolation)'];
            $cc = $resultCTD['avg(moduleTemp)'];
            $dc = $resultCTD['avg(dcCUF)'];
            $ec = $resultCTD['avg(acCUF)'];
            $fc = 100*($ac/($bc*$DCcapacity));
            $gc = $resultCTD['sum(corrInsolation)'];
            $hc = 100*($ac/($gc*$DCcapacity));
            $ic = $resultCTD['avg(plantAvail)'];
            $jc = $resultCTD['avg(gridAvail)'];
            $kc = $resultCTD['avg(generationAvail)'];
            $lc = $resultCTD['sum(module)'];
            $insert_ctd = "insert into ".$_SESSION['id']."CTD (dat,export,insolation,temp,dcCUF,acCUF,PR,corrInsolation,gridCorrectedPR,plantAvail,gridAvail,generationAvail,module) values ('$date','$ac','$bc','$cc','$dc','$ec','$fc','$gc','$hc','$ic','$jc','$kc','$lc')";
            //echo $insert_ctd."<br/>";        
            mysqli_query($conn,$insert_ctd);           
            header("Location: plantgraph.php?insertData=success");
            exit();
    } 

}
 
?>
