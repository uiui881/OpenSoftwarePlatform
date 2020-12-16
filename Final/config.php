<?php @ob_start();


   $conn = mysqli_connect("localhost","root", "team06", "ut");

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

?>
