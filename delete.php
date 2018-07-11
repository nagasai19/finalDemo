<?php 
session_start();
include 'logDbInc.php';
if(isset($_POST["del"]))
{
	$date = mysqli_real_escape_string($conn,$_POST["date"]) ;
	if(empty($date))
	{
		header("Location: plantgraph.php?dateDelete=empty" );
		exit();
	}
	else
	{
		$sql = " select * from ".$_SESSION['id']." where dat ='$date'";
		
		$result = mysqli_query($conn,$sql);
		$result_check = mysqli_num_rows($result);
    	if($result_check<1){
    	header("Location: plantgraph.php?deleteDate=no_date_found");
    	exit();
    	}
    		else
    		{
    			$sql = " delete from ".$_SESSION['id']." where dat ='$date'";
		         mysqli_query($conn,$sql);
		         $sqlMtd = " delete from ".$_SESSION['id']."MTD where dat ='$date'";
		         mysqli_query($conn,$sqlMtd);
		         $sqlYtd = " delete from ".$_SESSION['id']."YTD where dat ='$date'";
		         mysqli_query($conn,$sqlYtd);
		         $sqlCtd = " delete from ".$_SESSION['id']."CTD where dat ='$date'";
		         mysqli_query($conn,$sqlCtd);
		        header("Location: plantgraph.php?dateDelete=Success" );
		        exit();
    		}		
	}
}else
    {
       header("Location: plantgraph.php?dateDelete=empty" );
	    exit();
	} 
?>
