<?php
include 'modChart.php'; 
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
  <title>Module Cleaning</title>
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
     .body {
  font-family: "Open Sans", sans-serif;
  line-height: 1;
}  
.table {
  border: 0.2px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}


table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}

.tabletr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}

.tableth,
.tabletd {
 padding: .625em;
  text-align: left;
}

.tableth {
  font-size: .85em;
  }

@media screen and (max-width: 600px) {
  .table {
    border: 0;
  }
    
table caption {
    font-size: 1.3em;
  }
  
  .tablethead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  .tabletr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  .tabletd {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
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
  
            <a href="#" class="nav-link"><?php echo ucfirst($_SESSION['id']);?></a>
      </li>
        
      </li>
    </ul>
<?php include 'nav.php';
 include 'aside.php';
?>
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
          <div class="col-md-12">
           

            <!-- DONUT CHART -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Module Cleaning Data</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
 <table cellspacing="0" cellpadding="0" class="table" >
 
  <thead class="tablethead">
    <tr class="tabletr">
      <th scope="col" class="tableth">Actual Structure Cleaned-MTD</th>
      <th scope="col" class="tableth">Estimated Structure Cleaned-MTD</th>
      <th scope="col" class="tableth">Progress-MTD</th>
      <th scope="col" class="tableth">Actual Structure Cleaned-CTD</th>
        <th scope="col" class="tableth">Estimated Structure Cleaned-CTD</th>
      <th scope="col" class="tableth">Progress-CTD</th>
          <th scope="col" class="tableth">Status</th>
    </tr>
  </thead>
  <tbody class="body">
    <tr class="tabletr">
      <td data-label="Actual Structure Cleaned-MTD" class="tabletd" id ="m3"><?php echo $a[3] ;?></td>
      <td data-label="Estimated Structure Cleaned-MTD" class="tabletd" id ="m4"><?php echo $a[1] ;?></td>
      <td data-label="Progress-MTD" class="tabletd" id ="m5"><?php echo $a[9] ;?> %</td>
      <td data-label="Actual Structure Cleaned-CTD" class="tabletd" id ="m6"><?php echo $a[7] ;?></td>
        <td data-label="Estimated Structure Cleaned-CTD" class="tabletd" id ="m7"><?php echo $a[2] ;?></td>
      <td data-label="Progress-CTD" class="tabletd" id ="m8"><?php echo $a[10] ;?> %</td>
          <td data-label="STATUS" class="tabletd" id ="m9"><?php echo $a[8] ;?></td>
    </tr>
    </tbody>
</table>
               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (LEFT) -->
         
          <!-- /.col (RIGHT) -->
        </div>

        <div class="row">
        
           <div class="col">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"><?php echo ucfirst($_SESSION['id']);?> - MTD Module Cleaning</h3>

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
    

<?php include 'asideJs.php';?>
<script type="text/javascript">
 document.getElementById("month").defaultValue = <?php echo '"'.$year.'-'.$month.'-'.$day.'"' ;?> ; 
    function printPage()
{
     window.print();
}
var x="";
var a= [];
function myFunction(str) {
  
          var xmlhttp = new XMLHttpRequest();
        
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               x = this.responseText;
                
                x = x.split("&");
                for (var i =0;i<x.length;i++) {
                  a[i] = x[i].split(",");
                  //console.log(a[i]);
                }
                for(var i =3;i<10;i++){
                  document.getElementById('m'+i).innerHTML = a[i];
                  console.log(a[i]);
                }
              
chart1.data.datasets[0].data = a[0];
chart1.data.datasets[1].data = a[1];
chart1.data.labels = a[2];
chart1.update();
}

    };
        xmlhttp.open("POST", "modChart.php", true);
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xmlhttp.send("value=" + str);
    }

  //chart                  
//chart 1
        var ctx1 = document.getElementById('myChart1').getContext('2d');
        var data1 = {
        datasets: [{
          data: [<?php echo $a[4]; ?>],
      backgroundColor: 'transparent',
      
      borderColor: "#39a",
      borderWidth: 5,
          label: 'Module Cleaned' // for legend
        },{
          data: [<?php echo $a[5]; ?>],
      backgroundColor: 'transparent',
      borderColor: "#FF9800",
      borderWidth: 5,
      // Changes this dataset to become a line
          //type: 'line',
          label:  'Estimated Value' // for legend
        }],
        labels: [
          <?php echo $a[6]; ?>
        ]
      };
var chart1 = new Chart(ctx1, {
    // The type of chart we want to create
    type: 'line',

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
