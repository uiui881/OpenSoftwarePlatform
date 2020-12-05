<?php @ob_start();
   $startdate=new DateTime("11/24");
   $todaydate=new DateTime(date("m/d"));
   
   $dd=date_diff($startdate,$todaydate);

   $conn = mysqli_connect("localhost","root", "159753", "ut");

   $conn->set_charset("utf8");

   mysqli_query($conn, "set names utf8;");
   mysqli_query($conn, "set session character_set_connection=utf8;");
   mysqli_query($conn, "set session character_set_results=utf8;");
   mysqli_query($conn, "set session character_set_client=utf8;");


//echo date_format($startdate,"m/d");
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
<title>My Calander</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta charset="utf-8">
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<style type="text/css">
.cal_top{
    text-align: center;
    font-size: 30px;
}
.cal{
    text-align: center; 
}
table.calendar{
    border: 1px solid black;
    display: inline-table;
    //text-align: left;
}
table.calendar td{
    vertical-align: top;
    border: 1px solid skyblue;
    width: 100px;
}
</style>

<head>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&display=swap');
  body {
    font-family: 'Do Hyeon', sans-serif;
  }
  ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
  }

  li {
    float: right;
  }

  li a {
    height: 20px;
    display: block;
    color: gray;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 20px;
  }

  li a:hover {
    color: #ff0000;
  }

  i {
    position: relative;
  }
  </style>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
</head> 
<body>
<ul>
    <li><a href="#"><i class="material-icons" style="verticle-align: middle;">account_circle</i> LogOut</a></li>
    <li><a href="#"><i class="material-icons">speed</i> WeightLog</a></li>
    <li><a href="#"><i class="material-icons">calendar_today</i> Calender</a></li>
    <li><a href="#"><i class="material-icons">videocam</i> Videos</a></li>
    <li><a href="#"><i class="material-icons">home</i> Home</a></li>
  </ul> 
  <img src="logo2.png" width="70" height="70">
  <h1>&nbsp &nbsp My Calendar</h1> 
 
    <div class="cal_top">
        <a href="#" id="movePrevMonth"><span id="prevMonth" class="cal_tit">&lt;&nbsp</span></a>
        <span id="cal_top_year"></span>
        <span id="cal_top_month"></span>
        <a href="#" id="moveNextMonth"><span id="nextMonth" class="cal_tit">&nbsp&gt;</span></a>
    </div>
    <div id="cal_tab" class="cal">
    </div>
 
<script type="text/javascript">
    var today = null;
    var year = null;
    var month = null;
    var firstDay = null;
    var lastDay = null;
    var $tdDay = null;
    var $tdSche = null;
    var jsonData = null;

    var yearEx="<?php echo date_format($startdate,"Y"); ?>";
    var monthEx="<?php echo date_format($startdate,"m"); ?>";
    var dayEx="<?php echo date_format($startdate,"d"); ?>";

    $(document).ready(function() {
        drawCalendar();
        initDate();
        drawDays();
        drawSche();
        $("#movePrevMonth").on("click", function(){movePrevMonth();});
        $("#moveNextMonth").on("click", function(){moveNextMonth();});
    });
    
    //Calendar 그리기
    function drawCalendar(){
        var setTableHTML = "";
        setTableHTML+='<table class="calendar">';
        setTableHTML+='<tr><th>SUN</th><th>MON</th><th>TUE</th><th>WED</th><th>THU</th><th>FRI</th><th>SAT</th></tr>';
        for(var i=0;i<6;i++){
            setTableHTML+='<tr height="100">';
            for(var j=0;j<7;j++){
                setTableHTML+='<td style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap">';
                setTableHTML+='    <div class="cal-day"></div>';
                setTableHTML+='    <div class="cal-schedule"></div>';
                setTableHTML+='</td>';
            }
            setTableHTML+='</tr>';
        }
        setTableHTML+='</table>';
        $("#cal_tab").html(setTableHTML);
    }
    
    //날짜 초기화
    function initDate(){
        $tdDay = $("td div.cal-day")
        $tdSche = $("td div.cal-schedule")
        dayCount = 0;
        today = new Date();
        year = today.getFullYear();
        month = today.getMonth()+1;
        if(month < 10){month = "0"+month;}
        firstDay = new Date(year,month-1,1);
        lastDay = new Date(year,month,0);
    }
    
    //calendar 날짜표시
    function drawDays(){
        $("#cal_top_year").text(year);
        $("#cal_top_month").text(month);
        for(var i=firstDay.getDay();i<firstDay.getDay()+lastDay.getDate();i++){
            $tdDay.eq(i).text(++dayCount);
        }
        for(var i=0;i<42;i+=7){
            $tdDay.eq(i).css("color","red");
        }
        for(var i=6;i<42;i+=7){
            $tdDay.eq(i).css("color","blue");
        }
    }
    
    //calendar 월 이동
    function movePrevMonth(){
        month--;
        if(month<=0){
            month=12;
            year--;
        }
        if(month<10){
            month=String("0"+month);
        }
        getNewInfo();
    }
    
    function moveNextMonth(){
        month++;
        if(month>12){
            month=1;
            year++;
        }
        if(month<10){
            month=String("0"+month);
        }
        getNewInfo();
    }
    
    //정보갱신
    function getNewInfo(){
        for(var i=0;i<42;i++){
            $tdDay.eq(i).text("");
            $tdSche.eq(i).text("");
        }
        dayCount=0;
        firstDay = new Date(year,month-1,1);
        lastDay = new Date(year,month,0);
        drawDays();
        drawSche();
    }
    
    //데이터 등록
    function setData(){

        jsonData = 
        {
            "2020":{
                "07":{
                    "17":"제헌절"
                }
                ,"08":{
                    "7":"칠석"
                    ,"15":"광복절"
                    ,"23":"처서"
                }
                ,"09":{
                    "13":"추석"
                    ,"23":"추분"
                }
            },
            yearEx:{
                monthEx:{
                    dayEx:"O"
                }
            }
        }

    }
    
    //스케줄 그리기
    function drawSche(){
        setData();
        var dateMatch = null;

        for(var i=firstDay.getDay();i<firstDay.getDay()+lastDay.getDate();i++){
            var txt = "";
            txt =jsonData[year];
            if(txt){                
                txt = jsonData[year][month];
                if(txt){
                    txt = jsonData[year][month][i];
                    dateMatch = firstDay.getDay() + i -1; 
                    $tdSche.eq(dateMatch).text(txt);
                }
            }
        }
    }
    
    
</script>
</body> 
</html> 
