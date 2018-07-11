<?php
include 'dataInc.php';     
    include 'logDbInc.php';
     
    if(!isset($_SESSION['uid'])){
  header("Location: index.php?invalidPage");
                        exit;
}        
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Data Info</title>
      <link rel="icon" href="smile.png">

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionimcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<script src="plugins/jquery/jquery.min.js"></script>
 <style> 
 
.day {
    width: 60%;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    
    background-color: white;
    
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 4px 20px 4px 20px;
}
button{
  padding: 4px 20px 4px 20px;
  width: 100px;
  height :30px;
}
</style>
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
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>
        
        
        
        
       <?php 
      include 'nav.php';
      include 'aside.php';?>
      


     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
  

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <br>
          <br>
          
        <div class="row">
        
            <div class="col">
            <div class="card card-default">
              <div class="card-header">
              <strong>Plant <?php echo ucfirst($_SESSION['id']);?>.</strong> 

                <div class="card-tools">
                 
       


                  
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
 
            <h4 class="text-center">
              Enter Date:<input type = "date" id ="mon" onchange="myFunction(this.value)">
            </h4>
        </div>
        <div id="no-more-tables">
            <table class="col-md-12 table-bordered table-striped table-condensed cf">
          <thead class="cf">
           <tr>
           
            <th>Name</th>
            <th class="numeric">Todays's</th>
            <th class="numeric">MTD</th>
            <th class="numeric">CTD</th>
            
           </tr>
          </thead>
          <tbody>
           <tr>
            
               <td data-title="Name"><a href="#" data-toggle="tooltip" data-placement="top" title="TVM metering value">Actual Export</a></td>
            <td data-title="Today's" class="numeric" id="t[1]"><?php echo $a[0] ;?></td>
            <td data-title="MTD" class="numeric"  id="t[11]"><?php echo $b[0] ;?></td>
            <td data-title="CTD" class="numeric" id="t[21]"><?php echo $c[0] ;?></td>
           
            
           </tr>
           <tr>
            
            <td data-title="Name"><a href="#" data-toggle="tooltip" data-placement="top" title="Estimated as per PVSYST"> Estimated Avg Export</a></td>
            <td data-title="Today's" class="numeric" id="t[31]"><?php echo $d[0] ;?></td>
            <td data-title="MTD" class="numeric" id="t[35]"><?php echo $d[4] ;?></td>
            <td data-title="CTD" class="numeric"  id="t[37]"><?php echo $f[1] ;?></td>
            
            
           </tr>
           <tr>
            
            <td data-title="Name"><a href="#" data-toggle="tooltip" data-placement="top" title="As per onsite WMS data">Actual Insolation</a></td>
            <td data-title="Today's" class="numeric" id="t[2]"><?php echo $a[1] ;?></td>
            <td data-title="MTD" class="numeric"  id="t[12]"><?php echo $b[1] ;?></td>
            <td data-title="CTD" class="numeric" id="t[22]"><?php echo $c[1] ;?></td>
            
            
           </tr>
           <tr>
            
            <td data-title="Name"><a href="#" data-toggle="tooltip" data-placement="top" title="Estimated as per PVSYST">Estimated Avg Insolation</a></td>
            <td data-title="Today's" class="numeric" id="t[32]"><?php echo $d[1] ;?></td>
            <td data-title="MTD" class="numeric"  id="t[36]"><?php echo $d[5] ;?></td>
            <td data-title="CTD" class="numeric" id="t[38]"><?php echo $f[2] ;?></td>
            
            
           </tr>
           <tr>
            
            <td data-title="Name"><a href="#" data-toggle="tooltip" data-placement="top" title="As per onsite WMS data">Module Temp</a></td>
            <td data-title="Today's" class="numeric" id="t[3]"><?php echo $a[2] ;?></td>
            <td data-title="MTD" class="numeric" id="t[13]"><?php echo $b[2] ;?></td>
            <td data-title="CTD" class="numeric"id="t[23]"><?php echo $c[2] ;?></td>
           
            
           </tr>
           <tr>
           
            <td data-title="Name"><a href="#" data-toggle="tooltip" data-placement="top" title="Actual Export/(24*DC Capacity)">DC CUF%</a></td>
            <td data-title="Today's" class="numeric" id="t[4]"><?php echo $a[3] ;?></td>
            <td data-title="MTD" class="numeric" id="t[14]"><?php echo $b[3] ;?></td>
            <td data-title="CTD" class="numeric"id="t[24]"><?php echo $c[3] ;?></td>
           
            
           </tr>
           <tr>
            
            <td data-title="Name"><a href="#" data-toggle="tooltip" data-placement="top" title="Actual Export/(24*AC Capacity)">Actual CUF%</a></td>
            <td data-title="Today's" class="numeric" id="t[5]"><?php echo $a[4] ;?></td>
            <td data-title="MTD" class="numeric" id="t[15]"><?php echo $b[4] ;?></td>
            <td data-title="CTD" class="numeric"id="t[25]"><?php echo $c[4] ;?></td>
           
           
           </tr>
           <tr>
            
               <td data-title="Name"><a href="#" data-toggle="tooltip" data-placement="top" title="Actual Export/(24*AC Capacity)">Estimated Base CUF</a></td>
            <td data-title="Today's" class="numeric" id="t[33]"><?php echo $d[2] ;?></td>
            <td data-title="MTD" class="numeric"  id="t[33]"><?php echo $d[2] ;?></td>
            <td data-title="CTD" class="numeric" id="t[39]"><?php echo $f[3] ;?></td>
            
           
           </tr>

           <tr>
            
               <td data-title="Name"><a href="#" data-toggle="tooltip" data-placement="top" title="Actual export/(Actual insoaltion * DC capacity of plant)">Actual PR</a></td>
            <td data-title="Today's" class="numeric" id="t[6]"><?php echo $a[5] ;?></td>
            <td data-title="MTD" class="numeric" id="t[16]"><?php echo $b[5] ;?></td>
            <td data-title="CTD" class="numeric"id="t[26]"><?php echo $c[5] ;?></td>
            
           
           </tr>
           <tr>
            
               <td data-title="Name"><a href="#" data-toggle="tooltip" data-placement="top" title="Total Export/(Grid Corrected Insolation*DC Capacity)">Grid corrected PR</a></td>
            <td data-title="Today's" class="numeric" id="t[7]"><?php echo $a[6] ;?></td>
            <td data-title="MTD" class="numeric" id="t[17]"><?php echo $b[6] ;?></td>
            <td data-title="CTD" class="numeric"id="t[27]"><?php echo $c[6] ;?></td>
            
           
           </tr>
           <tr>
            
               <td data-title="Name"><a href="#" data-toggle="tooltip" data-placement="top" title="Estimated Avg Export/(Estimated Avg Insolation*DC Capacity)">Estimated Base Case PR</a></td>
            <td data-title="Today's" class="numeric" id="t[34]"><?php echo $d[3] ;?></td>
            <td data-title="MTD" class="numeric"   id="t[34]"><?php echo $d[3] ;?></td>
            <td data-title="CTD" class="numeric" id="t[40]"><?php echo $f[4] ;?></td>
            
           
           </tr>
           <tr>
            
            <td data-title="Name"><a href="#" data-toggle="tooltip" data-placement="top" title="1-[(1-Inv)+(1-S.C.B)+(1-String)] ">Plant Availability</a>
   <style>.tooltip-inner {
  white-space:nowrap;
  max-width:none;
}</style>
  
                  <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script></td>
            <td data-title="Today's" class="numeric" id="t[8]"><?php echo $a[7] ;?></td>
            <td data-title="MTD" class="numeric"id="t[18]"><?php echo $b[7] ;?></td>
            <td data-title="CTD" class="numeric"id="t[28]"><?php echo $c[7] ;?></td>
            
           
           </tr>
           <tr>
            
               <td data-title="Name"><a href="#" data-toggle="tooltip" data-placement="top" title="1-(Grid Breakdown duration/Sun Availability)">Grid Availability</a></td>
            <td data-title="Today's" class="numeric" id="t[9]"><?php echo $a[8] ;?></td>
            <td data-title="MTD" class="numeric"id="t[19]"><?php echo $b[8] ;?></td>
            <td data-title="CTD" class="numeric"id="t[29]"><?php echo $c[8] ;?></td>
            
            
           </tr>
           <tr>
            
               <td data-title="Name"><a href="#" data-toggle="tooltip" data-placement="top" title="1-[(1-PA)+(1-GA)]">Generation Availability</a></td>
            <td data-title="Today's" class="numeric" id="t[10]"><?php echo $a[9] ;?></td>
            <td data-title="MTD" class="numeric"id="t[20]"><?php echo $b[9] ;?></td>
            <td data-title="CTD" class="numeric"id="t[30]"><?php echo $c[9] ;?></td> 
           </tr>

           <tr>
            
            <td data-title="Name"><a href="#" data-toggle="tooltip" data-placement="top" title="Summary">Comments</a></td>
            <td data-title="Today's" class="numeric" id="t[41]"><b><?php echo $a[10] ;?></b></td>
           
            
           
           </tr>
          </tbody>
         </table>
        </div>
    </div>
    
</div>
          </div>
        </div>
      </section>
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
      
    </div>
      <script> 
 document.getElementById("mon").defaultValue = <?php echo '"'.$year.'-'.$month.'-'.$day.'"' ;?> ;
var x="";
var a=[];
function myFunction(str) {
  
          var xmlhttp = new XMLHttpRequest();
        
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               x = this.responseText; 
                x = x.split("&");
                console.log(x.length);
               for(var i=0;i<x.length;i++)
               {
                a[i] = x[i].split(",");
               }
               for(var i=1;i<x.length;i++)
               {
                console.log(a[i]);
                console.log("t["+i+"]");
                document.getElementById("t["+i+"]").innerHTML = a[i];
                //document.getElementById("dc").innerHTML = tr[0];
               }
                }
              };
    xmlhttp.open("POST", "dataInc.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send("value=" + str);
    }
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
    </div>
    </body>
</html>


<style type="text/css">
    body
    {
           
    }
    
    @media only screen and (max-width: 800px) {
    
    /* Force table to not be like tables anymore */
 #no-more-tables table,
 #no-more-tables thead,
 #no-more-tables tbody,
 #no-more-tables th,
 #no-more-tables td,
 #no-more-tables tr {
  display: block;
       
 }
 
 /* Hide table headers (but not display: none;, for accessibility) */
 #no-more-tables thead tr {
  position: absolute;
  top: -9999px;
  left: -9999px;
 }
 
 #no-more-tables tr { border: 1px solid #ccc; }
 
 #no-more-tables td {
  /* Behave like a "row" */
  border: none;
  border-bottom: 1px solid #eee;
  position: relative;
  padding-left: 50%;
  white-space: normal;
  text-align:left;
 }
 
 #no-more-tables td:before {
  /* Now like a table header */
  position: absolute;
  /* Top/left values mimic padding */
  top: 6px;
  left: 6px;
  width: 45%;
  padding-right: 10px;
  white-space: nowrap;
  text-align:left;
  font-weight: bold;
 }
 
 /*
 Label the data
 */
 #no-more-tables td:before { content: attr(data-title); }
}
            </style>              
    
        
          
       
        
        
         
       

         
