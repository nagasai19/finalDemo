<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login -Solar pro</title>
      <link rel="icon" href="smile.png">

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Sign in </title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

    
 <style>   
body  {
    background-image: url("main-background.jpg");
  
}

	.login-form {
		width: 385px;
		margin: 70px auto;
	}
    .login-form form {        
    	margin-bottom: 25px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .login-btn {
        min-height: 38px;
        border-radius: 2px;
    }
    
    .login-btn {
        font-size: 15px;
        font-weight: bold;
    }
     .center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 60%;
}
	
    }   
</style>
</head>
<body>
<div class="login-form">
    <form action="clientLogInc.php"  method="POST">
     
                                      
        <h2 class="text-center">Welcome to Solar Pro</h2>
        <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                        	
                            <img class="center" src="smile.png ">
                            <br/>
                            
                            
                        </div>
                   
        <br/>
        <div class="form-group">
                    	<div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" name="uid" placeholder="Username" required="required">				
            </div>
        </div>
		<div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control"  name="pass"  placeholder="Password" required="required">				
            </div>
        </div>        
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary login-btn btn-block">Login</button>
        </div> </div>
        <h5>For more, visit   <a href="https://www.solarpro.co.in/" target="_blank">solarpro.co.in</a></h5>
                            <style>
                            a:link
                            {
                            text-decoration: none;
                                }
                            </style>
                            
     </form> 
    
        </div>
  
     
   
   

</body>
</html>                            
