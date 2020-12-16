<?php

//SQL환경 설정
include "config.php";

	$SQL = " SELECT video_id AS caID, done AS DD, date AS start FROM record WHERE user_id='".$_GET["user_id"]."' ";
	$result = mysqli_query($conn, $SQL);

	$ret_arr = array();
	foreach($result as $row)
	{
		$row_array['id'] = urlencode($row["caID"]);
		if($row['DD']==1){
			$SQL1="SELECT title AS title1 FROM video WHERE video_id='".$row["caID"]."';";
			$RES1 = mysqli_query($conn, $SQL1);
			$ROW1 = mysqli_fetch_array($RES1);
			$str=$ROW1["title1"];
		//	$str=substr($str, 5);
			$row_array['title'] = urlencode($str);
		}
		//$row_array['title'] = urlencode($row["title"]);
		$row_array['start'] = urlencode($row["start"]);
		array_push($ret_arr, $row_array);
	}

	echo urldecode(json_encode($ret_arr));

?>
