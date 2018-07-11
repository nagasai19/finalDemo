<?php
session_start();
include 'logDbInc.php';
if(!isset($_SESSION['uid']))
          {
            header("Location: index.php?loginfirst");
                        exit;
          }
if(!(isset($_POST["update"])||isset($_POST["insert"])))
{
  header("Location: plantgraph.php?dateSearch=empty" );
exit();
}else
{     
        $date = mysqli_real_escape_string($conn,$_POST["date"]) ;
        if(empty($date))
        {
                header("Location: plantgraph.php?dateSearch=empty" );
                exit();
        }}
         $sql = " select * from ".$_SESSION['id']." where dat ='$date'";
                $result = mysqli_query($conn,$sql);
                $result_check = mysqli_num_rows($result);
                $row = mysqli_fetch_assoc($result);
   if(isset($_POST["update"]))
            {
                $_SESSION['operation']="update";
                if($result_check<1)
                    {
                    header("Location: plantgraph.php?searchDate=no_date_found");
                    exit();

                    }}

          ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Register</title>
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
   
}</style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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



<?php include 'nav.php';
include 'aside.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    
	</div>



       <?php
        
               
                $_SESSION['Date']=$date;
            if(isset($_POST["insert"]))
            {
                if($result_check<1)
                {
                    
                    $_SESSION['operation']="insert";
                 echo '<b>You are inserting the value of : '.$_SESSION['Date'].' and plant : '.$_SESSION['id'].'</b><br>';
                

                }else
                {
                  
                    $_SESSION['operation']="update";
                    echo '<b>you are trying to overwrite the value of date : '.$_SESSION['Date'].' and plant : '.$_SESSION['id'].'</b><br>';
                }                  
            }

            else
                    {
                           
                         echo '<b>You are updating the value of : '.$_SESSION['Date'].' and plant : '.$_SESSION['id'].'</b><br>';                  
                    }               
            ?><br>
  <form action = "updateInc.php" method = "POST">
                        
                           <div class="row">
        <div class="col-sm-6 form-group">
            <label> Today Actual Export :</label>
            <input type="int" name="dayExport" placeholder="" class="form-control"> 
        </div>
        <div class="col-sm-6 form-group"> 
            <label>Today Actual Insolation :</label>
            <input type="float" name="dayInsolation" placeholder="" class="form-control" >
        </div> 
    </div> 
    
    <div class="row">
        <div class="col-sm-6 form-group">
            <label> Sun Rise :</label>
            <input type="time" name="rise" placeholder="" class="form-control"> 
        </div>
        <div class="col-sm-6 form-group"> 
            <label> Sun Set :</label>
            <input type="time" name="set" placeholder="" class="form-control" >
        </div> 
    </div> 
           <div class="row"> 
        <div class="col-sm-6 form-group"> 
            <label>Module Temperature :</label> 
            <input type ="float" name= "moduleTemp" placeholder="" class="form-control"> 
        </div> 
        
        <div class="col-sm-6 form-group">
            <label>Inverter Breakdown Time:</label>
            <input type ="string" name= "bdInverter" placeholder="
            hhh:mm"value="00:00" class="form-control" >
        </div> 
    </div>                 
      <div class="row">
        <div class="col-sm-6 form-group">
          <label> Grid Breakdown Time :</label>
          <input type ="string" name= "bdGrid" placeholder="hhh:mm" value="00:00" class="form-control">
        </div>
        <div class="col-sm-6 form-group">
          <label> SCB Breakdown Time :</label>
          <input type ="string" name= "bdSCB" placeholder="hhh:mm" value="00:00" class="form-control">
        </div>
      </div>
                            
      <div class="row">
        <div class="col-sm-6 form-group">
            <label>string Breakdown Time :</label>
            <input type ="string" name= "bdStr" placeholder="hhh:mm" value="00:00" class="form-control">
          </div>
          <div class="col-sm-6 form-group">
             <label>Grid corrected Insolation : </label>
              <input type ="float" name= "corr" class="form-control">
                            
          </div>
      </div>
      <div class="row"> 
        <div class="col-sm-12 form-group"> 
            <label>Module Cleaned :</label> 
            <input type ="float" name= "module" placeholder="" class="form-control"> 
        </div> 
      </div> 

      <div class="row">
        <div class="col form-group"> 
            <label>Cycle Status Of Module Cleaning</label>
            <textarea name="status" rows="8" cols="50" placeholder="" class="form-control" ></textarea>
            
        </div>
    </div>                     
                            
      <div class="row">
        <div class="col form-group"> 
            <label>Comments</label>
            <textarea name="comments" rows="8" cols="50" placeholder="" class="form-control" ></textarea>
            
        </div>
    </div>       
    <button style="float:left" class="btn btn-xd btn-info" type ="submit" name ="admin">Submit</button>
       <a style="float:right" href="plantgraph.php"><b>Cancel</b></a>                   
        </form>
  </section>
    <!-- /.content -->
  </div>
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
    
    </body>
</html>



































