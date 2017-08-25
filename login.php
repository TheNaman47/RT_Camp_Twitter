<?php
session_start();
require 'autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY', 'ohRgYmHe7Hm1dKBBJQzvUh9wG'); // add your app consumer key between single quotes
define('CONSUMER_SECRET', 'GbDwjDpMz3AN3W2gPoz9XBtZD2PC6dcrmxf2U7tjadBvF2bbSQ'); // add your app consumer secret key between single quotes
define('OAUTH_CALLBACK', 'https://timetable1.000webhostapp.com/callback.php'); // your app callback URL
define('ACCESS_TOKEN', '2177672922-IUePckCRYno4zpZuv8tx8vsq6QnkBYUBYmxvQhG');
define('ACCESS_TOKEN_SECRET','NbjmkVh9HMTFpNd99dcEyfIuud2SVyHO7FG2gKc2bJkcC');

if (!isset($_SESSION['access_token'])) {
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
	header('Location: '.$url);
    exit();
} 
else {
	$access_token = $_SESSION['access_token'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	$user = $connection->get("account/verify_credentials");
	//displaying user information
		echo '<html>';
	echo '<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Twitter Login</title>
   <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
   <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   <!-- Bootstrap -->
   <link href = "css/bootstrap.min.css" rel = "stylesheet">
</head>';
	echo '<body>';
echo '<div class="w3-container w3-teal">
	<h1>Tweet Fetcher</h1>
  </div>';
	echo '<div class="container-fluid" style="background: #466368;
  background: linear-gradient(to right bottom, #648880, #293f50);">';
	
	echo '<br><img src="'.$user->profile_image_url. '" class="img-circle" alt="set a profile pic" width="100" height="100"><br>';
	echo '<b>Hi, </b>' . $user->screen_name . '.<br>';
	echo '<b><u>Your Recent Tweet: </u></b>' . $user->status->text . '<br>';
	echo '<b><u>Total Tweets: </u></b>' . $user->statuses_count . '<br>';
$arr_name = null;
	$arr_media_url = null;
	$arr_tweet = null;
	if (!isset($_SESSION['userTimelineObj'])) {
		//getting tweets and printing them
		$statuses = $connection->get("statuses/home_timeline", ["count" => 10, "exclude_replies" => true]);
		$totalTweets[] = $statuses;
		
		$start = 0;
		foreach($totalTweets as $page){
			foreach($page as $key){
				if (array_key_exists("name",$key->user)) {
					$arr_name[$start] = $key->user->name;
				}
				
				if (array_key_exists("text",$key)) {
					$arr_tweet[$start] = $key->text;
				}
				
				if (array_key_exists("media",$key->entities)) {
					$arr_media_url[$start] = $key->entities->media[0]->media_url;
				}
				$start++;
			}
		}
		$_SESSION['user_name_arr'] = $arr_name;
		$_SESSION['tweets_arr'] = $arr_tweet;
		$_SESSION['media_url_arr'] = $arr_media_url;
	}else {
		$fetching_users_timeline_tweets = $_SESSION['userTimelineObj'];
		$totalTweets[] = $fetching_users_timeline_tweets;
		$start = 0;
		foreach($totalTweets as $page){
			foreach($page as $key){
				if (array_key_exists("name",$key->user)) {
					$arr_name[$start] = $key->user->name;
				}

				if (array_key_exists("text",$key)) {
					$arr_tweet[$start] = $key->text;
				}
				
				if (array_key_exists("media",$key->entities)) {
					$arr_media_url[$start] = $key->entities->media[0]->media_url;
				}
				$start++;
			}
		}
		$_SESSION['user_name_arr'] = $arr_name;
		$_SESSION['tweets_arr'] = $arr_tweet;
		$_SESSION['media_url_arr'] = $arr_media_url;
	}


        //getting user ids
	$ids = $connection->get("followers/list", ["cursor"=>-1, "screen_name"=>$user->screen_name, "include_user_entries"=>false, "count"=>200]);
        $ids_arr[] = $ids;
        $start1 = 0;
        foreach($ids->users as $i){
		$ayy[$start1] = $i->screen_name;
                $start1++;
        }
        $_SESSION['followers_ayy'] = $ayy;
echo '<script src = "https://code.jquery.com/jquery.js"></script>
	<script src = "js/bootstrap.min.js"></script>';
echo '</div>';
	echo '</body>';
	echo '</html>';
        require 'slider.php';
}
?>
