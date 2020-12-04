<?php @ob_start();
   $startdate=new DateTime("11/24");
   $todaydate=new DateTime(date("m/d"));
   
   $dd=date_diff($startdate,$todaydate);

   $conn = mysqli_connect("localhost","root", "pw", "ut");

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

  // $sql="SELECT date FROM record";
  // $res = mysqli_query($conn,$sql);

?> 

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
   <form action="" method="POST">
      <label> Day + <?php echo $dd->days?></label><bt>
      <input type="checkbox" name="chk1"><?php echo date("m/d")?>
      <input type="submit" name="sub" value="Confirm">
   </form>
      <br>


<?php
   $just=$_POST['chk1'];
   //echo $just;

   if($just=="on"){
      $sql="insert into record(user_id, video_id, date, done) values (1,1,'".date("Y-m-d")."',TRUE)";
      $res = mysqli_query($conn,$sql);
   }
   

?>
<!--
<script type="text/javascript">
  /* var chk1=document.getElementById('chkBox');
   var chk_t=chk1.getAttribute("checked");
   if(chk_t) */
      function checkClick() {
        // var chk1=document.getElementById('chkBox');
         //alert(chk1);
 
         if ($("input:checkbox[name='chk1']").is(":checked") == true) {
                //체크가 되어있을때.
               alert("버튼을 클릭하였습니다.");

         } else {
                //체크가 안되어있을때.
                alert("실패");
         }
      }

</script> -->
</body>
</html>
