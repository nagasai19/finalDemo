<?php
session_start();
    include 'logDbInc.php';

          if(!isset($_SESSION['uid']))
          {
            header("Location: index.php?loginfirst");
                        exit;
          } 
          $va="";
          $sqlpa = mysqli_query($conn,"select plant from info");
            while($rowpa = mysqli_fetch_assoc($sqlpa)){
              $va = $va.$rowpa['plant']."&";
            }
           $_SESSION['id'] = "";
          ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title>Register User</title>
      <link rel="icon" href="smile.png">

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <style>

  .button {
    background-color: #37474F; /* Green */
    border: none;
    color: white;
    padding: 5px;
    text-align: left;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 20px;
    width : 100%;
 hover {
    background-color: #f44336;
    color: white;
}
}
</style>
<style>


/* Space out content a bit */
body {
  padding-top: 20px;
  padding-bottom: 20px;
}

/* Everything but the jumbotron gets side spacing for mobile first views */
.header,
.marketing,
.footer {
  padding-right: 15px;
  padding-left: 15px;
}

/* Custom page header */
.header {
  border-bottom: 1px solid #e5e5e5;
}
/* Make the masthead heading the same height as the navigation */
.header h3 {
  padding-bottom: 19px;
  margin-top: 0;
  margin-bottom: 0;
  line-height: 40px;
}

/* Custom page footer */
.footer {
  padding-top: 19px;
  color: #777;
  border-top: 1px solid #e5e5e5;
}

/* Customize container */
@media (min-width: 768px) {
  .container {
    max-width: 730px;
  }
}
.container-narrow > hr {
  margin: 30px 0;
}

/* Main marketing message and sign up button */
.jumbotron {
  text-align: center;
  border-bottom: 1px solid #e5e5e5;
}
.jumbotron .btn {
  padding: 14px 24px;
  font-size: 21px;
}


/* Responsive: Portrait tablets and up */
@media screen and (min-width: 768px) {
  /* Remove the padding we set earlier */
  .header,
  .marketing,
  .footer {
    padding-right: 0;
    padding-left: 0;
  }
  /* Space out the masthead */
  .header {
    margin-bottom: 30px;
  }
  /* Remove the bottom border on the jumbotron for visual effect */
  .jumbotron {
    border-bottom: 0;
  }
}
</style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <style>
  .button {
    background-color: #37474F; /* Green */
    border: none;
    color: white;
    padding: 5px;
    text-align: left;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 20px;
    width : 100%;
 hover {
    background-color: #f44336;
    color: white;
}
}
</style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="finalindex.php" class="nav-link">Home</a>
      </li>
     
    </ul>

    <!-- SEARCH FORM 
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>

     Right navbar links -->
    
  <!-- /.navbar -->


<?php 
include 'nav.php';
include 'aside.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        

     
    <h1 class="well">Registeration Form</h1>
          <hr>
    <form   action="signUpInc.php" method="POST">
	<div class="col-lg-12 well">
	<div class="row">
				
					<div class="col-sm-12">
						
							
							
										
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>Name:</label>
								<input type="text" name="fname" placeholder="Name" class="form-control">
							</div>	
                            <div class="col-sm-6 form-group">
								<label>Role : </label>			
                  <select name="lname" class="form-control">
          <option value="">Select</option>
          <option value="admin">Admin</option>
          <option value="sub">SubAdmin</option>
          <option value="client">Client</option>
        </select>
							</div>	
						</div>	
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>E-mail:</label>
								<input type="text" name="email" placeholder="abc@gmail.com"class="form-control">
							</div>	
							<div class="col-sm-6 form-group">
								<label>User Name:</label>
								<input type="text" name="uid" placeholder="john@client" class="form-control">
							</div>	
								
						</div>
											
					<div class="form-group">
						<label>Password:</label>
						<input type="password" name="pass" placeholder="Enter Unique Password" class="form-control">
					</div>	
                        <div class="form-group">
						<label>Retype-Password:</label>
						<input type ="text" name= "check"  placeholder="Password Should Match" class="form-control">
					</div>
          <div class="form-group">
            <label>Plants : </label>
            <select name="select2[]" id="select2[]" multiple="multiple" class="form-control"></select>
          </div>
					
					<button type ="submit" name="submit" class="btn btn-xd btn-info">Register</button>	
          <a style="float:right" href="finalindex.php"><b>Cancel</b></a> 
                        <hr>
					</div>
				
				</div>
	</div>
    </form>
	</div>



        
    
    </section>
    <!-- /.content -->
  </div>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <?php
      echo "Today is ".date("Y/m/d");
      echo "," .date("l");
      ?>
    </div>
    <strong>Copyright &copy;<a href="https://www.solarpro.co.in/" target="blank">SolarPro</a>.</strong>All Rights Reserved.
  </footer>
  <?php include 'asideJs.php';?>
  <script >
    var na="";
    var va = <?php echo '"'.$va.'"' ;?>;
    va = va.split("&");
    for(var i=0;i<va.length-1;i++)
    {
      na += "<option value = '"+va[i]+"'>"+va[i]+"</option>";

    }
    document.getElementById('select2[]').innerHTML= na;
    console.log(va);
      
      console.log(na);
  </script>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="plugins/chartjs-old/Chart.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
    </div>
    </body>
</html>
