<?php
include 'chartComp.php';
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
  <title>Comparision</title>
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
        <a href="#" class="nav-link">Contact</a>
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
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><strong>Actual Export v/s Estimated Export - DSG</strong></h3>

                <div class="card-tools">
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
        
            <div class="col">
            <div class="card card-info">
              <div class="card-header">
                <h3  id="plan" class="card-title"><strong>Actual Export v/s Estimated Export - MTD</strong> </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                 
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="myChart1"  style="height:40vh; width:80vw"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>


          <div class="row">
        
           <div class="col">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><strong>Actual Export v/s Estimated Export - CTD</strong></h3>

                <div class="card-tools">
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
            <div class="card card-info">
              <div class="card-header">
                <h3  id="plan" class="card-title"><strong>Plant Availability - CTD</strong> </h3>

                <div class="card-tools">
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
           

           
            <!-- /.card -->
 
        
          <!-- /.col (RIGHT) -->
        </div>
         </section>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <?php
      echo "Today is ".date("Y/m/d");
      echo "," .date("l");
      ?>
    </div>
    <strong>Copyright &copy;<a href="https://www.solarpro.co.in/" target="blank">SolarPro</a>.</strong>All Rights Reserved.
  </footer>
    <!-- /.content -->

  <!-- /.content-wrapper -->
  
  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->


 
<?php include 'asideJs.php';?>
<script> 
 document.getElementById("month").defaultValue = <?php echo '"'.$year.'-'.$month.'-'.$day.'"' ;?> ;
 var a = [];

  function printPage()
{
     window.print();
}

 function myFunction(str) {
  
        var xmlhttp = new XMLHttpRequest();     
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               x = this.responseText;
                console.log(x);
                x = x.split("/");
                var count = x[0];
                console.log(count);
                for (var i =0;i<=count;i++)
                {
                  a[i] = x[i+1].split(",")
                }
                console.log(a[4]);
                var label = x[1+parseInt(count, 10)+1].split(",");
                var estMTD = x[2+parseInt(count, 10)+1].split(",");
                var expMTD = x[3+parseInt(count, 10)+1].split(",");
                var estDSG = x[4+parseInt(count, 10)+1].split(",");
                var expDSG = x[5+parseInt(count, 10)+1].split(",");
                var estCTD = x[6+parseInt(count, 10)+1].split(",");
                var expCTD = x[7+parseInt(count, 10)+1].split(",");
               
chart1.data.datasets[0].data =expMTD;
chart1.data.datasets[1].data = estMTD;
chart1.data.labels = label;
chart1.update();

chart3.data.datasets[0].data =expDSG;
chart3.data.datasets[1].data = estDSG;
chart3.data.labels = label;
chart3.update();

chart2.data.datasets[0].data =expCTD;
chart2.data.datasets[1].data = estCTD;
chart2.data.labels = label;
chart2.update();
for (var i =0;i<count;i++)
chart4.data.datasets[i].data =a[i];

chart4.data.labels = a[count];
chart4.update(); 
console.log(label);     
               
       }
    };
    xmlhttp.open("POST", "chartComp.php", true);
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      console.log(str);
        xmlhttp.send("value=" + str);
}

//chart 1
  var ctx1 = document.getElementById('myChart1').getContext('2d');
        var data1 = {
        datasets: [{
          data: [<?php echo $expMTD; ?>],
      backgroundColor: '#39a',
      
      borderColor: "#39a",
      borderWidth: 5,
          label: 'MTD Export' // for legend
        },{
          data: [<?php echo $estMTD; ?>],
      backgroundColor: '#FF9800',
      borderColor: "#FF9800",
      borderWidth: 5,
      // Changes this dataset to become a line
          //type: 'line',
          label:  'MTD Estimated Export' // for legend
        }],
        labels: [<?php echo $label; ?>]
      };
var chart1 = new Chart(ctx1, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
  data: data1,

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
//charts
  var ctx3 = document.getElementById('myChart3').getContext('2d');
        var data3 = {
        datasets: [{
          data: [<?php echo $expDSG; ?>],
      backgroundColor: '#39a',
      
      borderColor: "#39a",
      borderWidth: 5,
          label: 'DSG Export' // for legend
        },{
          data: [<?php echo $estDSG; ?>],
      backgroundColor: '#FF9800',
      borderColor: "#FF9800",
      borderWidth: 5,
      // Changes this dataset to become a line
          //type: 'line',
          label:  'DSG Estimated Export' // for legend
        }],
        labels: [<?php echo $label; ?>]
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

//chart 2
//charts
  var ctx2 = document.getElementById('myChart2').getContext('2d');
        var data2 = {
        datasets: [{
          data: [<?php echo $expCTD; ?>],
      backgroundColor: '#39a',
      
      borderColor: "#39a",
      borderWidth: 5,
          label: 'CTD Export' // for legend
        },{
          data: [<?php echo $estCTD; ?>],
      backgroundColor: '#FF9800',
      borderColor: "#FF9800",
      borderWidth: 5,
      // Changes this dataset to become a line
          //type: 'line',
          label:  'CTD Estimated Export' // for legend
        }],
        labels: [<?php echo $label; ?>]
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

//chart 4


  var ctx4 = document.getElementById('myChart4').getContext('2d');
        var data4 = {
        datasets: [<?php echo $l;?>],
        labels: [<?php echo $a[0][10]; ?>]
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
                   beginAtZero: true
                }
            }]
        }}
});
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
