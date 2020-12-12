<?php
	session_start();
	
	include "conndb.php";
	$db_link=db_conn();  //데이터베이스와 연결하는 사용자 정의 함수
	mysqli_select_db($db_link,$DB_SNAME); //내부 database 선택

	$SQL = "SELECT user_id as user_id, video_id as video_id FROM record";
	$resultHouse = mysqli_query($db_link, $SQL);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>펜션예약</title>
  <link href='fullcalendar.min.css' rel='stylesheet' />
  <link href='fullcalendar.print.min.css' rel='stylesheet' media='print' />
  <script src="jquery.min.js"></script>
  <script src="jquery-ui.min.js"></script>
  <script src='moment.min.js'></script>
  <script src='fullcalendar.min.js'></script>
  <script src='fullcalendar_ko.js'></script>
<body>
	<div style="width:1000px; margin:0px auto; background-color:white; margin-top:30px">
		<table style="width:100%">
			<button onclick="javascript:clickPension(this, '<?=$idx?>', '<?=$row['user_id']?>');">
		</table>
	</div>

</body>
<script src="jquery.bpopup2.min.js" type="text/javascript"></script>
<script>
	function execReservation(userID, videoID, selectedDate)
	{
		$("#insert_userid").val(userID);
		$("#divHouseName").html(videoID);
		$("#reservation_date").val(selectedDate);

		$('#winReservation').bPopup();
	}

	var selectedPension = "";
	var selectedPensionDetail = "";
	function clickPension(objThis, idx, userID, videoID)
	{
		if(selectedPension)
		{
			$(selectedPension).attr("selectpension","");
			unSelectPension(selectedPension);
			if(selectedPensionDetail)
			{
				selectedPensionDetail.hide();
			}
		}

		selectedPension = objThis;
		selectedPensionDetail = $("#trCalendar"+idx);
		$(objThis).attr("selectpension","ok");

		showPensionDetail(objThis, idx, userID, videoID);
	}

	function selectPension(objThis)
	{
		$(objThis).css('background-color','#aaaaaa'); 
		$(objThis).css('color','white')
	}

	function unSelectPension(objThis)
	{
		if($(objThis).attr("selectpension") != "ok")
		{
			$(objThis).css('background-color','white'); 
			$(objThis).css('color','black')
		}
	}

	function showPensionDetail(objThis, idx, userID, videoID)
	{
		selectedPensionDetail.show();
		alert(userID);
		$('#calendar'+idx).fullCalendar({
		  editable: true,
		  navLinks: true,
		  eventLimit: true,
		  locale : "ko",
		  events: {
		  	color:"#FFFF00",
			url: 'getPensionReservation.php?user_id='+userID,
			error: function() {
			  $('#script-warning').show();
			}
		  },
			dayClick: function(date, jsEvent, view) {
				var selectedDate = date.format();  //yyyy-mm-dd
				execReservation(userID, videoID, selectedDate);
			}
		});
	}

</script>
</html>