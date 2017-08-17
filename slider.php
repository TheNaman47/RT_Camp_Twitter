<html>
<head>
<meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Welcome to Tweet Fetcher</title>
      <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
      
      <!-- Bootstrap -->
      <link href = "css/bootstrap.min.css" rel = "stylesheet">
<link rel="stylesheet" type="text/css" href="lib/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="lib/slick/slick-theme.css"/>
    <style>
body{background: #466368;
  background: linear-gradient(to right bottom, #648880, #293f50); }

  input[type=text] {
    width: 130px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    padding: 12px 20px 12px 10px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
    width: 100%;
}
    </style>
    
</head>
<body>
<div class="container-fluid" style="background: #4099FF; background: radial-gradient(#e5e5ff, #4099FF);">
    <?php
       $fetching_tweet_arr[] = $_SESSION['tweets_arr'];
       $fetching_user_names_arr[] = $_SESSION['user_name_arr'];
       $fetching_followers_arr[] = $_SESSION['followers_ayy'];
       $fetching_media_url_arr[] = $_SESSION['media_url_arr'];
    ?>
   <br>
   <div class="autoplay">
       <?php
       $index=1;
        for ($i=0; $i < 10; $i++) { 
            echo '<div style="height: auto; ">';
            echo $index . ". " . $fetching_user_names_arr[0][$i] . '<br>';
            echo $fetching_tweet_arr[0][$i];
           if (!empty($fetching_media_url_arr[0][$i])) {
                echo '<div style="display: flex;justify-content: left; align-items: left;overflow: hidden; ">';
                echo '<img src="'.$fetching_media_url_arr[0][$i].'" style="flex-shrink:0; max-width: 50%; max-height: 50%; width: auto; height: auto"/><br>';
                echo '</div>';
            }
            echo '</div>';
            $index++;
        }
       ?>
   </div>
 


<script type="text/javascript">
        $(document).ready(function(){
            $('.autoplay').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                });
            });
</script>
</div>
<div style="position: relative;">
<br><b><p style="font-size=1.5em; font-color:#17202A">Here are some of your Followers: </p></b><br>
<?php
$index=1;
$temp=0;
foreach ($fetching_followers_arr as $key => $value) {
    foreach($value as $ans){
        echo '<div style="background-color: lightblue;width: 300px;padding: 5px;border: 2px solid gray;margin: 0;">' . $index . '. ' . $ans . '</div>';
        $temp_arr[$temp] = $ans;
        $temp++;
        $index++;
}}  
$_SESSION["temp_search"] = $temp_arr;
?>
</div>

<div style="position: relative;">
<br>
<p><b>Search Your Followers:</b></p>

<input type="text" name="search" onkeyup="showHint(this.value)" placeholder="Search..">
<hr/>
<span id="results"></span>

<script>
    function showHint(str) {
        if (str.length == 0 || str == " ") {
            document.getElementById("txtHint").innnerHTML = "";
            return;
        }
        else{
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("results").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "instant_search.php?q="+ str, true);
            xmlhttp.send();
        }
    }
</script>

</div>

<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
</body>
</html>