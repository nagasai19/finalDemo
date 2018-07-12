<?php
include 'chart.php';
     
    include 'logDbInc.php';
     
           
           if (isset($_POST["plant"])){
   $id=$_POST["plant"];
   $_SESSION['id'] = $id;
}  
if(empty($_SESSION['id'])){
  header("Location: finalindex.php?invalid");
                        exit;
}         
 ?>  
<!DOCTYPE html>         
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title>Plant Graph</title>
      <link rel="icon" href="smile.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
<style type="text/css">
    
    table {
      margin: auto;
      font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
      font-size: 12px;
    }
    h1 {
      margin: 25px auto 0;
      text-align: center;
      text-transform: uppercase;
      font-size: 17px;
    }
    table td {
      transition: all .5s;
    }
    
    /* Table */
    .data-table {
      border-collapse: collapse;
      font-size: 14px;
      min-width: 537px;
    }
    .data-table th, 
    .data-table td {
      border: 1px solid #e1edff;
      padding: 7px 17px;
    }
    .data-table caption {
      margin: 7px;
    }
    /* Table Header */
    .data-table thead th {
      background-color: #508abb;
      color: #FFFFFF;
      border-color: #6ea1cc !important;
      
    }
    /* Table Body */
    .data-table tbody td {
      color: #353535;
    }
    .data-table tbody td:first-child,
    .data-table tbody td:nth-child(4),
    .data-table tbody td:last-child {
      text-align: right;
    }
    .data-table tbody tr:nth-child(odd) td {
      background-color: #f4fbff;
    }
    
    /* Table Footer */
  
    .data-table tbody td:empty
    {
      background-color: #ffcccc;
    }
  </style>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>



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
          <li class="nav-item d-none d-sm-inline-block">
  
            <a href="#" class="nav-link" data-toggle="tooltip" data-placement="right" title= "AC Capacity is <?php echo ucfirst($e[1]/1000);?> MW, DC Capacity is <?php echo ucfirst($e[0]/1000);?> MW, Inverters:<?php echo ucfirst($e[2]);?> ,Client is <?php echo ucfirst($e[3]);?> "><?php echo ucfirst($_SESSION['id']);?></a>
      </li>
        
      </li>
         </ul>
<?php 
include 'nav.php';
include 'aside.php';
?>
    <!-- SEARCH FORM -->
   <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>-->

    <!-- Right navbar links -->
    
  <!-- /.navbar -->



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
       <table class="data-table">
    
    <thead>
      <tr>
        
        
        
        <th>DC CUF</th>
                <th>AC CUF</th>
                <th>BASE CUF</th>
                <th>Module Temp</th>
                
                <th>Gen Avail</th>
                
                
               
                <th>Comments</th>
      </tr>
        
      
    </thead>
    <tbody id ="data">
      <tr>
        <td id="dc"><?php echo $dc ?></td>
        <td id="ac"><?php echo $ac ?></td>
        <td id="base"><?php echo $base ?></td>
        <td id="mt"><?php echo $mt ?></td>
        <td id="ga"><?php echo $ga ?></td>
        <td id="co"><?php echo $co ?></td>
      </tr>
    </tbody>
    
  </table>

      </div>
        <div class="row mb-2">
          <div class="col-sm-3">
           
          </div>
          <div class="col-sm-9">
            <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item">  <input type = "date" id ="month" onchange="myFunction(this.value)"></li>
             
              <li class="breadcrumb-item"><a href="finalindex.php" ">  Home  </a></li>
              <li class="breadcrumb-item active"><button onclick=" printPage()">Print</button></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
        
            <div class="col">
            <div class="card card-default">
              <div class="card-header">
                <h3  id="plan" class="card-title">Actual Export v/s Estimated Export </h3>
                <div class="card-tools">
                  
                  
                     <a href="#" data-toggle="tooltip" data-placement="top" title= "Estimated avg. export is Estimated as per PVSYST">i</a>
                  
                  
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                 
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="myChart3"  style="height:40vh; width:80vw"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <div class="row">
        
            <div class="col-sm-4">
            <div class="card card-default">
              <div class="card-header">
                <h3  id="plan" class="card-title"> Export v/s Estimated Daily </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                 
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="myChart5" style="height:40vh; width:24vw" ></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
       
        
        
            <div class="col-sm-4">
            <div class="card card-default">
              <div class="card-header">
                <h3  id="plan" class="card-title"> Export v/s Estimated MTD </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                 
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="myChart6"  style="height:40vh; width:24vw"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        
          <div class="col-sm-4">
            <div class="card card-default">
              <div class="card-header">
                <h3  id="plan" class="card-title"> Export v/s Estimated CTD </h3>
                <div class="card-tools">
               
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                 
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="myChart7"  style="height:50vh; width:30vw"></canvas>
                </div>
              </div>
                
            </div>
          </div>
       </div>
       
          <div class="row">
        
           <div class="col">
            <div class="card card-">
              <div class="card-header">
                <h3 class="card-title">Plant Availability v/s Grid Availability</h3>
                <div class="card-tools">
                  <a href="#" data-toggle="tooltip" data-placement="top" title=" PA=1-[(1-Inv)+(1-S.C.B)+(1-String)], GA=1-(Grid Breakdown duration/Sun Avail)">i</a>
   <style>.tooltip-inner {
  white-space:nowrap;
  max-width:none;
}</style>
  
                  <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
                  
                  
                  
                  
                  
                  
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                    <canvas id="myChart"  style="height:40vh; width:80vw"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          </div>
            <div class="row">
        
           <div class="col">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"> Energy Index v/s Solar Index </h3>
                <div class="card-tools">
                  
                   <a href="#" data-toggle="tooltip" data-placement="top" title="Energy Index=Act Export/Est Avg Export, Solar Index=Act Insolation/Estimated Insolation">i</a>
       
                  
                  
                  
                  
                  
                  
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="myChart2"  style="height:40vh; width:80vw"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          </div>
            <div class="row">
        
           <div class="col">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">PR v/s Grid Corrected PR</h3>
                <div class="card-tools">
                  
                  <a href="#" data-toggle="tooltip" data-placement="top" title="Grid Corrected PR :Total Export/Grid Corr Insolation">i</a>
                  
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                    <canvas id="myChart4"  style="height:40vh; width:80vw"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          </div>
          <div class="row">
        
           <div class="col">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"> Plant Availability CTD </h3>
                <div class="card-tools">
                  <a href="#" data-toggle="tooltip" data-placement="top" title="Grid Corrected PR :Total Export/Grid Corr Insolation">i</a>
                  
                  
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="myChart8"  style="height:40vh; width:80vw"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          </div>
            <!-- /.card -->
 
        
          <!-- /.col (RIGHT) -->
        </div>
         
        <div class="row">
          <div class="col md-3">
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-default">
               
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username "><?php echo ucfirst($_SESSION['id']);?></h3>
                <h5 class="widget-user-desc"></h5>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column c">
                    <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                      MIS-Portal<span class="float-right badge bg-primary"></span>
                    </a>
                  </li> -->
                  <li class="nav-item">
                    <form  action="update.php" method="POST">
                      <input type="date" name="date" placeholder="YYYY-MM-DD" align="right" class="day">
                     <span class="float-right badge bg-default">
                       <button type ="submit" name="insert">Insert Date
                    </button>
                     </span>
                     
                    </form>
                     
                    
                  </li>
                  <li class="nav-item">
                   <form  action="update.php" method="POST">
                      <input type="date" name="date"  align="right" class="day">
                     <span class="float-right badge bg-default">
                       <button type ="submit" name="update">Update Date
                    </button>
                     </span>
                     
                    </form> 
                  </li>
                 
                  <li class="nav-item">
                   <form  action="delete.php" method="POST">
                      <input type="date" name="date"  align="right" class="day">
                     <span class="float-right badge bg-default">
                       <button type ="submit" name="del">Delete
                    </button>
                     </span>
                     
                    </form> 
                  </li>
                  <li class="nav-item">
                   <form  action="pvsyst.php" method="POST">
                      <input type="date" name="date"  align="right" class="day">
                     <span class="float-right badge bg-default">
                       <button type ="submit" name="pvsyst"> PVSYST
                    </button>
                     </span>
                     
                    </form> 
                  </li>
                 <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                      Projects <span class="float-right badge bg-success">Tasks</span>
                    </a>
                  </li> -->
                 
                </ul>
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
            
            
           
            
          </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <?php
      echo "Today is ".date("Y/m/d");
      echo "," .date("l");
      ?>
    </div>
    <strong>Copyright &copy;<a href="https://www.solarpro.co.in/" target="blank">SolarPro</a>.</strong>All Rights Reserved.
  </footer>
  
  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
</div>
 <?php include 'asideJs.php';?>
<script> 

  var chk = <?php echo $chk ;?>;
  if(chk == 1)
  {
    document.getElementById("month").defaultValue = <?php echo '"'.$year.'-'.$month.'-'.$day.'"' ;?> ;
var x="";
  //document.getElementById('plan').innerHTML = "Plant";
  //ajax function
  function printPage()
{
     window.print();
}
function myFunction(str) {
  
          var xmlhttp = new XMLHttpRequest();
        
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               x = this.responseText;
                
                x = x.split("/");
                var da = x[0].split(",");
                var expense = x[1].split(",");
                var revenue = x[2].split(",");
                var ene = x[3].split(",");
                var solar = x[4].split(",");
                var exp = x[5].split(",");
                var estiExp = x[6].split(",");
                var p = x[7].split(",");
                var gp = x[8].split(",");
                var ep = x[9].split(",");
                var label = x[10].split(",");
                var a = [x[11].split(",")];
                 a[1] = x[12].split(",");
                 a[2] = x[13].split(",");
                 a[3] = x[14].split(",");
                 a[4] = x[15].split(",");
                 a[5] = x[16].split(",");
                 a[6] = x[17].split(",");
                 a[7] = x[18].split(",");
                var tr = x[19].split(",");
                //var b = x[12].split(",");
                console.log(a[6]);
document.getElementById("dc").innerHTML = tr[0];
document.getElementById("ac").innerHTML = tr[1];
document.getElementById("base").innerHTML = tr[2];
document.getElementById("mt").innerHTML = tr[3];
document.getElementById("ga").innerHTML = tr[4];
document.getElementById("co").innerHTML = tr[5];
/////
chart.data.datasets[0].data = revenue;
chart.data.datasets[1].data = expense;
chart.data.labels = da;
chart.update();
chart2.data.datasets[0].data = ene;
chart2.data.datasets[1].data = solar;
chart2.data.labels = da;
chart2.update();
chart3.data.datasets[0].data = exp;
chart3.data.datasets[1].data = estiExp;
chart3.data.labels = da;
chart3.update();
chart4.data.datasets[0].data = p;
chart4.data.datasets[1].data = gp;
chart4.data.datasets[2].data = ep;
chart4.data.labels = da;
chart4.update();
chart5.data.datasets[0].data = a[0];
chart5.data.datasets[1].data = a[1];
chart5.data.labels = label;
chart5.update();
chart6.data.datasets[0].data = a[2];
chart6.data.datasets[1].data = a[3];
chart6.data.labels = label;
chart6.update();

chart7.data.datasets[0].data = a[4];
chart7.data.datasets[1].data = a[5];
chart7.data.labels = label;
chart7.update();

chart8.data.datasets[0].data = a[6];
chart8.data.labels = a[7];
chart8.update();                                             
                                             

      /////
 
   }
    };
    
    
        
        xmlhttp.open("POST", "chart.php", true);
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlhttp.send("value=" + str);
        
    
    }
  //chart 1
        var ctx = document.getElementById('myChart').getContext('2d');
        var data = {
        datasets: [{
          data: [<?php echo $revenues; ?>],
      backgroundColor: 'transparent',
      
      borderColor: "#39a",
      borderWidth: 5,
          label: 'Plant Avail' // for legend
        },{
          data: [<?php echo $expenses; ?>],
      backgroundColor: 'transparent',
      borderColor: "#FF9800",
      borderWidth: 5,
      // Changes this dataset to become a line
          //type: 'line',
          label:  'Grid Avail' // for legend
        }],
        labels: [
          <?php echo $dates; ?>
        ]
      };
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',
    // The data for our dataset
  data: data,
    // Configuration options go here
    options: {scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }}
});
// chart 2
  var ctx2 = document.getElementById('myChart2').getContext('2d');
        var data2 = {
        datasets: [{
          data: [<?php echo $ener; ?>],
      backgroundColor: 'transparent',
     
      borderColor: "#39a",
      borderWidth: 5,
          label: ' Energy Index' // for legend
        },{
          data: [<?php echo $sol; ?>],
      backgroundColor: 'transparent',
      borderColor: "#FF9800",
      borderWidth: 5,
      // Changes this dataset to become a line
          //type: 'line',
          label: 'Solar Index',
          type: 'line'
           // for legend
        }],
        labels: [
          <?php echo $dates; ?>
        ]
      };
var chart2 = new Chart(ctx2, {
    // The type of chart we want to create
    type: 'bar',
    // The data for our dataset
  data: data2,
    // Configuration options go here
    options: {scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }}
});
//chart 3
 var ctx3 = document.getElementById('myChart3').getContext('2d');
        var data3 = {
        datasets: [{
          data: [<?php echo $expo; ?>],
      backgroundColor: 'transparent',
      
      borderColor: "#39a",
      borderWidth: 5,
          label: 'Export' // for legend
        },{
          data: [<?php echo $estiExpo; ?>],
      backgroundColor: 'transparent',
      borderColor: "#FF9800",
      borderWidth: 5,
      // Changes this dataset to become a line
          //type: 'line',
          label: 'Estimated',
          type : 'line' // for legend
        }],
        labels: [
          <?php echo $dates; ?>
        ]
      };
var chart3 = new Chart(ctx3, {
    // The type of chart we want to create
    type: 'bar',
    // The data for our dataset
  data: data3,
    // Configuration options go here
    options: {scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }}
}); 
// chart 4
var ctx4 = document.getElementById('myChart4').getContext('2d');
        var data4 = {
        datasets: [{
          data: [<?php echo $PR; ?>],
      backgroundColor: 'transparent',
      
      borderColor: "#39a",
      borderWidth: 5,
          label: 'PR' // for legend
        },{
          data: [<?php echo $gridPR; ?>],
      backgroundColor: 'transparent',
      borderColor: "#FF9800",
      borderWidth: 5,
      // Changes this dataset to become a line
          //type: 'line',
          label: 'Grid Corrected PR',
          type : 'line' // for legend
        },{
          data: [<?php echo $estiPR; ?>],
      backgroundColor: 'transparent',
      borderColor: "#BBDEFB",
      borderWidth: 5,
      // Changes this dataset to become a line
          //type: 'line',
          label: 'Estimated PR',
          type : 'line' // for legend
        }],
        labels: [
          <?php echo $dates; ?>
        ]
      };
var chart4 = new Chart(ctx4, {
    // The type of chart we want to create
    type: 'line',
    // The data for our dataset
  data: data4,
    // Configuration options go here
    options: {scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }}
}); 
// chart 5
  var ctx5 = document.getElementById('myChart5').getContext('2d');
        var data5 = {
        datasets: [{
          data: [<?php echo $a[0]; ?>],
      backgroundColor: '#39a',
     
      borderColor: "#39a",
      borderWidth: 5,
          label: ' Export' // for legend
        },{
          data: [<?php echo $a[1]; ?>],
      backgroundColor: '#FF9800',
      borderColor: "#FF9800",
      borderWidth: 5,
      // Changes this dataset to become a line
          //type: 'line',
          label: 'Estimated',
          
           // for legend
        }],
        labels: [
          <?php echo $label; ?>
        ]
      };
var chart5 = new Chart(ctx5, {
    // The type of chart we want to create
    type: 'bar',
    // The data for our dataset
  data: data5,
    // Configuration options go here
    options: {scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }}
});
// chart 6
  var ctx6 = document.getElementById('myChart6').getContext('2d');
        var data6 = {
        datasets: [{
          data: [<?php echo $a[2]; ?>],
      backgroundColor: '#39a',
     
      borderColor: "#39a",
      borderWidth: 5,
          label: ' Export' // for legend
        },{
          data: [<?php echo $a[3]; ?>],
      backgroundColor: '#FF9800',
      borderColor: "#FF9800",
      borderWidth: 5,
      // Changes this dataset to become a line
          //type: 'line',
          label: 'Estimated',
          
           // for legend
        }],
        labels: [
          <?php echo $label; ?>
        ]
      };
var chart6 = new Chart(ctx6, {
    // The type of chart we want to create
    type: 'bar',
    // The data for our dataset
  data: data6,
    // Configuration options go here
    options: {scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }}
});
// chart 7
  var ctx7 = document.getElementById('myChart7').getContext('2d');
        var data7 = {
        datasets: [{
          data: [<?php echo $a[4]; ?>],
      backgroundColor: '#39a',
     
      borderColor: "#39a",
      borderWidth: 5,
          label: ' Export' // for legend
        },{
          data: [<?php echo $f[1]; ?>],
      backgroundColor: '#FF9800',
      borderColor: "#FF9800",
      borderWidth: 5,
      // Changes this dataset to become a line
          //type: 'line',
          label: 'Estimated',
          
           // for legend
        }],
        labels: [
          <?php echo $label; ?>
        ]
      };
var chart7 = new Chart(ctx7, {
    // The type of chart we want to create
    type: 'bar',
    // The data for our dataset
  data: data7,
    // Configuration options go here
    options: {scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }}
});
// chart 8
  var ctx8 = document.getElementById('myChart8').getContext('2d');
        var data8 = {
        datasets: [{
          data: [<?php echo $a[6]; ?>],
      backgroundColor: 'transparent',
     
      borderColor: "#39a",
      borderWidth: 5,
          label: 'Plant Availabity CTD' // for legend
        }],
        labels: [
          <?php echo $a[7]; ?>
        ]
      };
var chart8 = new Chart(ctx8, {
    // The type of chart we want to create
    type: 'line',
    // The data for our dataset
  data: data8,
    // Configuration options go here
    options: {scales: {
            yAxes: [{
                ticks: {
                    suggestedMin: 97,
                    suggestedMax: 100
                }
            }]
        }}
});
  }
 
  </script>
<!-- ./wrapper -->
<!-- jQuery -->
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
</body>
</html>
