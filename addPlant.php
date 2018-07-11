<?php
session_start();
include 'logDbInc.php';
 $plant = mysqli_real_escape_string($conn,$_POST["plant"]) ;
 $DCcapacity = mysqli_real_escape_string($conn,$_POST["DCcapacity"]) ;
 $ACcapacity = mysqli_real_escape_string($conn,$_POST["ACcapacity"]) ;
 $inverters = mysqli_real_escape_string($conn,$_POST["inverters"]) ;
 $SCB = mysqli_real_escape_string($conn,$_POST["SCB"]) ;
 $strings = mysqli_real_escape_string($conn,$_POST["strings"]) ;
 $uid = mysqli_real_escape_string($conn,$_POST["uid"]) ;
 
 if(isset($_POST['submit'])){

    $check = mysqli_query($conn,"select * from info where plant = '".$plant."'");
    $result = mysqli_num_rows($check);
    echo $result;
    if($result<1)
    {
        $sql = "insert into info (plant,DCcapacity,ACcapacity,inverters,SCB,strings,client) values ('$plant','$DCcapacity','$ACcapacity','$inverters','$SCB','$strings','$uid')";
    
    $tabPlant = "CREATE TABLE ".$plant." (  `dat` DATE NOT NULL , `sunAvail` FLOAT NOT NULL , `dayExport` int(11) NOT NULL , `dayInsolation` FLOAT NOT NULL , `dcCUF` FLOAT NOT NULL , `acCUF` FLOAT NOT NULL , `moduleTemp` FLOAT NOT NULL , `gridAvail` FLOAT NOT NULL , `plantAvail` FLOAT NOT NULL , `generationAvail` FLOAT NOT NULL , `PR` FLOAT NOT NULL , `corrInsolation` FLOAT NOT NULL , `gridCorrectedPR` FLOAT NOT NULL , `module` FLOAT ,`status` VARCHAR(2000) , `comments` VARCHAR(2000)  , PRIMARY KEY (`dat`))";
    
    $tabMTD = "CREATE TABLE ".$plant."MTD (  `dat` DATE NOT NULL , `export` FLOAT NOT NULL , `insolation` FLOAT NOT NULL , `temp` FLOAT NOT NULL , `dcCUF` FLOAT NOT NULL , `acCUF` FLOAT NOT NULL , `PR` FLOAT NOT NULL , `corrInsolation` FLOAT NOT NULL , `gridCorrectedPR` FLOAT NOT NULL , `plantAvail` FLOAT NOT NULL , `gridAvail` FLOAT NOT NULL , `generationAvail` FLOAT NOT NULL , `module` FLOAT , PRIMARY KEY (`dat`))";
    $tabYTD = "CREATE TABLE ".$plant."YTD (  `dat` DATE NOT NULL , `export` FLOAT NOT NULL , `insolation` FLOAT NOT NULL , `temp` FLOAT NOT NULL , `dcCUF` FLOAT NOT NULL , `acCUF` FLOAT NOT NULL , `PR` FLOAT NOT NULL , `corrInsolation` FLOAT NOT NULL , `gridCorrectedPR` FLOAT NOT NULL , `plantAvail` FLOAT NOT NULL , `gridAvail` FLOAT NOT NULL , `generationAvail` FLOAT NOT NULL , `module` FLOAT , PRIMARY KEY (`dat`))";
    $tabCTD = "CREATE TABLE ".$plant."CTD (  `dat` DATE NOT NULL , `export` FLOAT NOT NULL , `insolation` FLOAT NOT NULL , `temp` FLOAT NOT NULL , `dcCUF` FLOAT NOT NULL , `acCUF` FLOAT NOT NULL , `PR` FLOAT NOT NULL , `corrInsolation` FLOAT NOT NULL , `gridCorrectedPR` FLOAT NOT NULL , `plantAvail` FLOAT NOT NULL , `gridAvail` FLOAT NOT NULL , `generationAvail` FLOAT NOT NULL , `module` FLOAT , PRIMARY KEY (`dat`))";
    $tabEstimated = "CREATE TABLE ".$plant."Estimated ( `date` DATE NOT NULL , `export` FLOAT NOT NULL , `insolation` FLOAT NOT NULL , `baseCUF` FLOAT NOT NULL , `basePR` FLOAT NOT NULL , `module` FLOAT , PRIMARY KEY (`date`))";
    mysqli_query($conn,$sql);
    mysqli_query($conn,$tabPlant);
    mysqli_query($conn,$tabMTD);
    mysqli_query($conn,$tabYTD);
    mysqli_query($conn,$tabCTD);
    mysqli_query($conn,$tabEstimated);
    header("Location: finalindex.php?insert = success");
            exit();

    }else{
        $update = "update info set DCcapacity = '$DCcapacity', ACcapacity = '$ACcapacity', inverters = '$inverters' , SCB = '$SCB', strings = '$strings' , client ='$uid' where plant = '$plant' ";
        mysqli_query($conn,$update);
        header("Location: finalindex.php?update = success");
            exit();
    }



    
    //echo $tabEstimated;
 }
 else {
    header("Location: finalindex.php?insert = errror");
            exit();
 }
 
?>
