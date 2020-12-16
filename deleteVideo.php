<?php

include "header.php";
?>

<?php
    $video_id = $_GET['video_id'];
	$query_del = "DELETE FROM video WHERE video_id=$video_id";
	$result = mysqli_query($conn, $query_del);

		if ( $result ){

		?>
			<script>alert("delete success");
		location.replace('./main.php');</script>
		<?php

		}else{
		?>
			<script>alert("영상이 삭제되지 않습니다.")history.go(-1);</script>
		<?php
		}
		?>
