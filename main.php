<?php 
include "header.php";
?>
<?php
    $name = $_SESSION['name'];
    $sql1 = "SELECT * FROM users where name = '$name'";
    # name을 통해서 user정보를 찾기
    $result1 = mysqli_query($conn, $sql1); 
    $row1 = mysqli_fetch_array($result1);
    $user_id = $row1['user_id'];
    $goal = $row1['goal']; ## user goal을 찾기
    ##echo '<br>'.$goal;


    ?>

    <table>
      <tr><td><?php echo 'Welcome '.$name.'!!!'; ?></td><td></td></tr>
      <tr><td>목표 체중 : <?php echo $goal. 'kg';?>  </td> </tr>
       <tr><td>감량할 체중 : <?php 

       $sql4_1 = "SELECT max(date) as latest FROM weight_record where user_id = $user_id";
      $result4_1 = mysqli_query($conn, $sql4_1);
      $row4_1 = mysqli_fetch_array($result4_1);
      $latest = $row4_1['latest'];
      //echo $latest;
      $sql4 = "SELECT weight FROM weight_record where user_id = $user_id and date=$latest";
      $result4 = mysqli_query($conn, $sql4);
      while($row4 = mysqli_fetch_array($result4)){
        echo $row4['weight']-$goal.' kg left';}
      ?>  </td> </tr>
      <!--

      #<tr><td>목표 체중</td><td><?php #echo $goal. 'kg';?></td></tr>
      <tr><td>감량할 체중</td><td><?php
      # $sql4_1 = "SELECT max(date) as latest FROM weight_record where user_id = $user_id";
      #$result4_1 = mysqli_query($conn, $sql4_1);
      #$row4_1 = mysqli_fetch_array($result4_1);
      #$lastest = $row4_1['latest'];
      #echo $lastest;
      #$sql4 = "SELECT weight FROM weight_record where user_id = $user_id and date=$lastest";
      #$result4 = mysqli_query($conn, $sql4);
      #while($row4 = mysqli_fetch_array($result4)){
      #  echo $row4['weight']- $lastest;
        //echo $row4['weight']-$goal.' kg left';
      #}
      ?></td></tr>
      <br><br><br><br>
    -->
    <?php
  # user가 구독하고 있는 동영상 찾기
    $sql2 = "SELECT * FROM user_video where user_id = $user_id";
    $result2 = mysqli_query($conn, $sql2); 
    $i =0;
    #echo '<br>';
    echo '<tr>';
    while($row2 = mysqli_fetch_array($result2)){
        $video_id = $row2['video_id'];
        $sql3 = "SELECT * FROM video where video_id = $video_id";
        $result3 = mysqli_query($conn, $sql3);

        
        while($row3 = mysqli_fetch_array($result3)){
          ?>
            <td>
              <?php echo '<iframe width="400" height="200" src="'.$row3['link'].'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';?></td><?php
    
        $i+=1;
        if($i==3){
          echo '</tr><tr>';
          $sql2_1 = "SELECT * FROM user_video where user_id = $user_id";
    $result2_1 = mysqli_query($conn, $sql2_1); 
          while($row2_1 = mysqli_fetch_array($result2_1)){
        $video_id = $row2_1['video_id'];
        //echo video_id;
        $sql3_1 = "SELECT * FROM video where video_id = $video_id";
        $result3_1 = mysqli_query($conn, $sql3_1);
        while($row3_1 = mysqli_fetch_array($result3_1)){
          ?>
          <td><?php 
              $current = date('Y-m-d',time());
              $d_day = intval((strtotime($current) - strtotime($row3_1['startDate'])) / 86400);
              echo "D +".$d_day." days";  ?></td><?php
            }
          }
        } 


      }
    }echo '</tr></table>';
?>
