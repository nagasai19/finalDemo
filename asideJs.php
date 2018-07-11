<?php
    
    include 'logDbInc.php';
     $sqlz = mysqli_query($conn,"select plants from clientLogIn where uid = '".$_SESSION['uid']."'");
            $rowz = mysqli_fetch_assoc($sqlz);
            $k = $rowz['plants'];
            $v="";
    $sqlp = mysqli_query($conn,"select plant from info");
            while($rowp = mysqli_fetch_assoc($sqlp)){
              $v = $v.$rowp['plant']."&";
            }
    ?>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript">
    var j = <?php echo '"'.$k.'"' ;?>;
    var v = <?php echo '"'.$v.'"' ;?>;
    var k = <?php echo '"'.$_SESSION['person'].'"';?>;
    j = j.split("&");
    v = v.split("&");
    var n="";
    var plant = <?php echo '"'.$_SESSION['id'].'"';?>;
    console.log(plant);
    if(!(k=="admin")){
      for(var i=0;i<j.length-1;i++)
    {
      n += '<button type="submit" name="plant" class="button" value= "'+j[i]+'"><i class="fa fa-signal nav-icon" ></i>'+j[i]+'</button><br>';

    }
    
   
 console.log(j);
  }else {
       for(var i=0;i<v.length-1;i++)
    {
      n += '<button type="submit" name="plant" class="button" value= "'+v[i]+'"><i class="fa fa-signal nav-icon" ></i>'+v[i]+'</button><br>';

    }
     console.log(v);
    //document.getElementById('plant').innerHTML= n;
    //document.getElementById('select2[]').innerHTML= n;

  } document.getElementById('plant').innerHTML= n;
    
   
   

      
      //console.log(n);
      console.log(k);
      
    $(document).ready(function() {
      if(!(k=="admin")){
        $(".a").hide();
      }
      if(plant ===""){
        $(".b").hide();
      }
      if(k=="client"){
        $(".c").hide();
      }

      
      // body...
    });
 </script>