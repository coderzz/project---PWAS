<html>
<head>
<title>Graph</title>

<link rel="stylesheet" href="css/nv.d3.css" />

<script src="js/d3.v2.min.js"></script>
<script src="js/nv.d3.js"></script>


</head>
<body>
<?php
$con=mysqli_connect("localhost","root","","mydata");

if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
$valb=$_GET['a'];
$vald=$_GET['p'];
$vals=$_GET['q'];


  $zt=mysqli_query($con,"select count(habitation) from cdata where percentage>=0 and percentage<=20 and block='$valb' and district='$vald' and state='$vals'");
  $ztr=mysqli_fetch_array($zt);
  $ztv=$ztr['count(habitation)'];
    
  $tf=mysqli_query($con,"select count(habitation) from cdata where percentage>20 and percentage<=40 and block='$valb' and district='$vald' and state='$vals'");
  $tfr=mysqli_fetch_array($tf);
  $tfv=$tfr['count(habitation)'];
  
  
  $fs=mysqli_query($con,"select count(habitation) from cdata where percentage>40 and percentage<=60 and block='$valb' and district='$vald' and state='$vals'");
  $fsr=mysqli_fetch_array($fs);
  $fsv=$fsr['count(habitation)'];
  
  
  $se=mysqli_query($con,"select count(habitation) from cdata where percentage>60 and percentage<=80 and block='$valb' and district='$vald' and state='$vals'");
  $ser=mysqli_fetch_array($se);
  $sev=$ser['count(habitation)'];
  
  
  $eh=mysqli_query($con,"select count(habitation) from cdata where percentage>80 and percentage<=100 and block='$valb'and district='$vald' and state='$vals'");
  $ehr=mysqli_fetch_array($eh);
  $ehv=$ehr['count(habitation)'];
  
?>
<script >
var data = [
  {
    key: "",
    values: [
      { 
        "label": "0-20%",
        "value" : <?php echo $ztv;?>
      } , 
      { 
        "label": "20-40%",
        "value" : <?php echo $tfv;?>
      } , 
      { 
        "label": "40-60%",
        "value" : <?php echo $fsv;?>
      } , 
      { 
        "label": "60-80%",
        "value" : <?php echo $sev;?>
      } , 
      { 
        "label": "80-100%",
        "value" : <?php echo $ehv;?>
      } 
      
    ]
  }
];

nv.addGraph(function() {
  var chart = nv.models.pieChart()
      .x(function(d) { return d.label })
      .y(function(d) { return d.value })
      .showLabels(true);

    d3.select("#chart svg")
        .datum(data)
      .transition().duration(1200)
        .call(chart);

  return chart;
});

</script>
<style>

#chart svg {
  height: 400px;
}

</style>


<div id="chart">
  <svg></svg>
</div>


</body>
</html>


