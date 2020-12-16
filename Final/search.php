<?php
include "header.php";
include "addVideo.php";
?>

<html>
<head>
  <title>YouTraining - Search</title>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <style>
  input {
    border: 2px solid #ff0000;
    border-radius: 50px;
    width: 100%;
    height: 40px;
    font-size: 20px;
    padding-left: 15px;
    outline: none;
  }

  .search-icon {
    font-size: 35px;
    color: gray;
  }

  .search-icon:hover {
    color: #ff0000;
  }

  .search-btn {
    background: none;
    border: none;
    outline: none;
  }

  #video-tbl td {
    width:385px;
    vertical-align: top;
  }

  .add-icon {
    position:relative;
    top:7px;
    color: grey;
    font-size: 40px;
    float: right;
  }

  .add-icon:hover {
    color:red;
  }

  #star-btn {
    border: none;
    background: white;
    outline: none;
  }

  #redirect-btn {
    background-color: #ff0000;
    border: none;
    border-radius: 20px;
    padding: 5px;
    padding-left: 10px;
    font-size: 16px;
    cursor: pointer;
    transition-duration: 0.4s;
  }

  #redirect-btn:hover {
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
  }

  #youtube-link:link, #youtube-link:visited {
    text-decoration: none;
  }

  #youtube-link td, #youtube-link i {
    color: white;
  }

  </style>
</head>

<body style="margin-bottom: 100px;">

  <br><br>

  <!-- 직접 추가 -->
  <table style="width: 50%; margin:auto;">
    <tr>
      <td style="width: 20%; padding-top: 10px;"><h1>직접 추가</h1></td>
      <form method="post">
        <td><input type="text" placeholder="Enter YouTube Link" name="url" autofocus></td>
        <td style="width: 35px"><button class="search-btn" type="submit" name="link-add"><i class="search-icon material-icons">add_box</i></button><td>
      </form>
    </tr>
  </table>

  <?php
  function youtube_title($id) {
    // $id = 'YOUTUBE_ID';
    // returns a single line of JSON that contains the video title. Not a giant request.
    $videoTitle = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=".$id."&key=AIzaSyDBfXOaJM-0fqVBPgeVokceZ7LcLuOmSjg&fields=items(id,snippet(title),statistics)&part=snippet,statistics");
    // despite @ suppress, it will be false if it fails
    if ($videoTitle) {
      $json = json_decode($videoTitle, true);
      return $json['items'][0]['snippet']['title'];
    } else {
      return false;
    }
  }
  if (isset($_POST["link-add"]) && !empty($_POST["url"])) {
    if(substr($url,0,32) == "https://www.youtube.com/watch?v="){
      $url= $_POST['url'];
      $add_date = date("Y-m-d");
      $youtube_id= substr($url,-11);
      $title = youtube_title($youtube_id);
      addVideo($user_id, $add_date, $youtube_id, $title, $conn);
    }
    else {
      echo '
        <script>
          alert("You should write youtube link!");
        </script>';
    }
  }
  ?>

  <h2 style="width: 50%; margin: auto; padding-left: 10px;">or</h2>
  <br>

  <table style="width: 50%; margin:auto;">
    <tr><td colspan="2"><h1 style="margin-bottom: 5px;">Search</h1></td></tr>
    <tr>
      <form id="keywordForm" method="post">
        <td><input type="search" id="keyword" placeholder="Enter Keyword" name="keyword"></td>
        <td style="width: 35px"><button type="submit" class="search-btn" name="Search"><i class="search-icon material-icons">search</i></button></td>
      </form>
    <tr>
  </table>

  <br><br>

  <?php
  define("MAX_RESULTS", 15);

  if (isset($_POST["Search"]) ) {
    $keyword = $_POST['keyword'];

    if (empty($keyword)) {
      $response = array(
        "type" => "error",
        "message" => "Please enter the keyword."
      );
    }
  }

  if(!empty($response)) {
    echo '<div class="response '.$response["type"].'" style="width: 50%; margin: auto; font-size: 20px;"> '.$response["message"].' </div>';
  }
  ?>

  <?php
  if (isset($_POST['Search']) ) {

    if (!empty($keyword)) {
      $apikey = 'AIzaSyDBfXOaJM-0fqVBPgeVokceZ7LcLuOmSjg';
      $keyword = str_replace(' ', '', $keyword);
      $googleApiUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q=' . $keyword . '&maxResults=' . MAX_RESULTS . '&key=' . $apikey;

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_VERBOSE, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $response = curl_exec($ch);

      curl_close($ch);
      $data = json_decode($response);
      $value = json_decode(json_encode($data), true);

      // Print video search results
      echo '<table id="video-tbl" style="margin: auto; border-spacing: 50px">';

      $j = 0;
      for ($i = 0; $i < MAX_RESULTS; $i++) {
        $videoId = $value['items'][$i]['id']['videoId'];
        $videos[$i] = $videoId;
        $title = $value['items'][$i]['snippet']['title'];
        $description = $value['items'][$i]['snippet']['description'];

        if($j == '0') {
          echo '<tr>';
        }
        if($videoId!="") {
          echo '
            <td>
              <iframe width="385" height="215" src="https://www.youtube.com/embed/'.$videoId.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              <span style="width:335px; float:left; padding-top: 7px;"><b>'.$title.'</b></span>
              <a href="searchPopUp.php?search_add='.$videoId.'&title='.$title.'"><i class="add-icon material-icons">add_circle</i></a>
            </td>';

          $j++;
        }

        if($j == '3') {
          echo '</tr>';
          $j = 0;
        }
      }
      echo '</table>';

      echo '
      <div style="width: 75%; margin: auto; text-align: right;">
        <button id="redirect-btn">
        <a href="https://www.youtube.com/results?search_query=운동" target="_blank" id="youtube-link">
          <table style="border-spacing: 0px;">
              <tr>
                <td>Want more videos?</td>
                <td rowspan="2" style="padding-left: 5px;"><i class="material-icons" style="font-size: 45px;">outbond</i></td>
              </tr>
              <tr><td>Go to YouTube</td></tr>
          </table>
        </a>
      </button>
      </div>';
    }
  }
  ?>

</body>
</html>
