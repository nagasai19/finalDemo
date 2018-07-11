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
    	$sql ="select * from clientLogIn where uid='$uid'  ";
    	$result=mysqli_query($conn,$sql);
    	$result_check = mysqli_num_rows($result);
    	if($result_check<1){
    		header("Location: index.php?login=no_user");
    		exit();
    	}else{
    		if($row = mysqli_fetch_assoc($result)){
    			
    			//DEhashing the password
                $passCheck =password_verify($pass,$row['pass']);
                if($passCheck ==false)
    			{
    				header("Location: index.php?login=error");
	                exit();
    			}
    			elseif($passCheck ==true){
    				//log in the user
                    
    				//log in the user
                    $_SESSION['pid']=$row['id'];
                    $_SESSION['f_name']=$row['fname'];
                   $_SESSION['person']=$row['role'];
                    $_SESSION['e_mail']=$row['email'];
                    $_SESSION['uid']=$row['uid'];
                    

    				header("Location: finalindex.php?login=success");

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