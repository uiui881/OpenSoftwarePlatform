<?php
//include "header.php";
include "config.php";
?>
<?php
    $sql = "SELECT * FROM video";
    $result = mysqli_query($conn, $sql);
?>
<head>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
  .material-icons{
    font-size: 60pt;
    color: red;

}
</style>
</head>
<table style="border : 3px solid">
  <tr><th style="font-size: 60pt">My Video</th></tr>
 
  <tr >
    <?php  
    $i = 0;
     while($row = mysqli_fetch_array($result)){
     echo '<td>'.'<iframe width="400" height="200" src="'.$row['link'].'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'.'</td>';
     $i++;

     if($i==3){
        $i=0;
        echo '</tr><tr>';
     }
   }
     echo '</tr>';
     ?>

  <tr>
  <td></td>
  <td></td>
  <td></td>
   <td style="border : 3px solid; align-items: right" >
    <a href='add_video.php'><i class="material-icons" style="background-color: red; color: white;">search</i></a>
  </td>
  <td style="border : 3px solid; align-items: right" >
    <a href='add_video.php'><i class="material-icons">add_circle
</i></a>
  </td>
  <td></td>
  <td></td>
</tr>
</table>


