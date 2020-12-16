<?
	session_start();
	include "header.php";
	
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>My Calendar</title>
  <link href='fullcalendar.min.css' rel='stylesheet' />
  <link href='fullcalendar.print.min.css' rel='stylesheet' media='print' />
  <script src="jquery.min.js"></script>
  <script src="jquery-ui.min.js"></script>
  <script src='moment.min.js'></script>
  <script src='fullcalendar.min.js'></script>
  <script src='en-gb.js'></script>
<style type="text/css">
	#calendar{
		width:80%;
		height:80%;
		margin-top:30px;
		margin-left: 10%;
		text-align:center;
	}
</style>

</head>

<body>

<script>
		$(function () {
		// page is now ready, initialize the calendar...
			$('#calendar').fullCalendar({
			// put your options and callbacks here
				//clickPension(this,1,1,1);
				editable: true,
		  		navLinks: true,
		  		eventLimit: true,
		  		locale : "ko",
		  		events: {
		  			color: '#ff9a00',
					url: 'getPensionReservation.php?user_id='+'<?=$user_id?>',
					error: function() {
			  			$('#script-warning').show();
					}
		  		},
				dayClick: function(date, jsEvent, view) {
					var selectedDate = date.format();  //yyyy-mm-dd
					execReservation(userID, videoID, selectedDate);
					alert("ok!");
				}
			})
		});

	</script>
	<div id="calendar"> </div>
	<script type="text/javascript">
	//	document.getElementById("frame1").innerHTML=clickPension(this, 1, 1, 1);
	function showTitle(){

	}

	function getRandomColor() {
  		var letters = '0123456789ABCDEF';
 		var color = '#';
  		for (var i = 0; i < 6; i++) {
    		color += letters[Math.floor(Math.random() * 16)];
  		}
  		return color;
	}

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

		$('#calendar'+idx).fullCalendar({
		  editable: true,
		  navLinks: true,
		  eventLimit: true,
		  locale : "ko",
		  events: {
		  	color: getRandomColor(),
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
</body>
<script src="jquery.bpopup2.min.js" type="text/javascript"></script>
<script type="text/javascript">



	function saveReservation()
	{
		if(!$.trim($("#reservation_date").val()))
		{
			alert("예약날짜를 입력해주십시오");
			return false;
		}
		if(!$.trim($("#total_man").val()))
		{
			alert("숙박인원을 입력해주십시오");
			return false;
		}
		if(isNaN($("#total_man").val()))
		{
			alert("숙박인원을 숫자로 입력해주십시오");
			return false;
		}
		document.frm.submit();
	}

</script>
</html>
