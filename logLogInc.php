<?php
session_start();
if(isset($_POST['submit'])){
	include  'logDbInc.php';
	$uid = mysqli_real_escape_string($conn,$_POST['uid']) ;
    $pass = mysqli_real_escape_string($conn,$_POST['pass']) ;
//error handlers
     //check for empty fields
	if(empty($uid)||empty($pass)){
    	header("Location: index.php?login=empty");
	    exit();
    }
    //$sql="Select * from user_login where uid='$username'";
    else{
    	$sql ="select * from log where username='$uid'  ";
    	$result=mysqli_query($conn,$sql);
    	$result_check = mysqli_num_rows($result);
    	if($result_check<1){
    		header("Location: index.php?login=no_user");
    		exit();
    	}else{
    		if($row = mysqli_fetch_assoc($result)){
    			//DEhashing the password
                $uidCheck=substr_count($row['username'],"@admin" ) ;
    			$passCheck =$row['pass_word'];
    			if(!($pass ==$row['pass_word']))
    			{
    				header("Location: index.php?login=error");
	                exit();
    			}
    			elseif($pass ==$row['pass_word']){
    				//log in the user
                    
                    
    				$_SESSION['pid']=$row['uid'];
                   
    				
    				$_SESSION['uid']=$row['username'];

                    /*switch ($_SESSION['uid']) {
                        case "parigi":
                            # code...

                        header("Location: plants.php?login=success");
                            break;
                        case "kothagadi":
                                # code...
                                header("Location: plants.php?login=success");
                                break;    
                        case "peerampalle":
                            # code...
                        header("Location: plants.php?login=success");
                                break;
                        case "orai":
                            # code...
                        header("Location: plants.php?login=success");
                            break;
                        default:
                            # code...
                        header("Location: finalindex.php");
                            break;
                    }*/if($uidCheck==1){
                        $_SESSION['person'] = "admin";
                        header("Location: finalindex.php?login=success");
                    }
                    else{
                        $_SESSION['person'] = "client";
                        $_SESSION['id']=$row['username'];
                        header("Location: plantgraph.php?login=success");

                    }


    				

	                exit();
    			}
    		}
    	} 
    }
}
else {echo "please press submit button";
	header("Location: index.php?login=error");
	exit();
}
?>
