<!DOCTYPE html> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Check</title>
</head>
<body>
   <h1>&nbsp &nbsp Exercise Check</h1>

   <iframe width="560" height="315" src="https://www.youtube.com/embed/OwOfylESbB0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
   </iframe>
   <frame>
      <input type="checkbox" name="date1" value="date1" style="background-color: red"><?php echo date("m/d")?></input>
      <input type="checkbox" id="chkbox"><label for="chkbox"><em></em>체크</label>
   </frame>
      <br>
   
<?php @ob_start();
   $startdate=new DateTime("11/24");
   $todaydate=new DateTime(date("m/d"));
   
   $dd=date_diff($startdate,$todaydate);
   
   for($dayCount=1;$dayCount<=$dd->days+1;$dayCount++){
      echo "Day ".$dayCount."<br>";
      echo date_format($startdate,"m/d")."<br>";
      $startdate->modify('+1 day');
   }

   $conn = mysqli_connect("localhost","root", "159753", "ut");

   $conn->set_charset("utf8");

   mysqli_query($conn, "set names utf8;");
   mysqli_query($conn, "set session character_set_connection=utf8;");
   mysqli_query($conn, "set session character_set_results=utf8;");
   mysqli_query($conn, "set session character_set_client=utf8;");


   if ( mysqli_connect_errno() ){

      die( "Connection error: ".mysqli_connect_errno() );

   }else{

      //echo "connect success!\n";
      
   }

   $sql="SELECT date FROM record";
   $res = mysqli_query($conn,$sql);

   while ($row = mysqli_fetch_assoc($res)) {
      printf("date : %s", $row["date"]);
   }

?> 
</body>
</html>
