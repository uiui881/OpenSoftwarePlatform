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
      <tr><td><?php echo '<h1>Welcome '.$name.'!!!</h1>'; ?></td><td></td></tr>

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
              <?php echo '<iframe width="560" height="315" src="'.$row3['link'].'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';?></td>
              <td>
              <?php

              	$query = "SELECT count(date) as count from record where user_id = $user_id and video_id= $video_id and done=true";
 				$q_result = mysqli_query($conn, $query);
 				$q_row = mysqli_fetch_array($q_result);
 				echo '<h1>&nbsp carried out '.$q_row['count'].' times</h1>';
              ?>
              <br>&nbsp&nbsp&nbsp
              <button type="button" onClick="location.href='ExerciseCheck.php'" style="background-color: red; color: white; font-weight: bold; height: 20pt; border-radius: 8px; border-color: red;"> move to record </button>
              </script>
              </td></tr>


              <?php
      }
    }echo '</tr></table>';
?>
