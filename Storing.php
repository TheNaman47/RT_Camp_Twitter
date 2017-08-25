<?php
session_start();
require 'autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY', 'ohRgYmHe7Hm1dKBBJQzvUh9wG'); // add your app consumer key between single quotes
define('CONSUMER_SECRET', 'GbDwjDpMz3AN3W2gPoz9XBtZD2PC6dcrmxf2U7tjadBvF2bbSQ'); // add your app consumer secret key between single quotes
define('OAUTH_CALLBACK', 'https://timetable1.000webhostapp.com/callback.php'); // your app callback URL
define('ACCESS_TOKEN', '2177672922-IUePckCRYno4zpZuv8tx8vsq6QnkBYUBYmxvQhG');
define('ACCESS_TOKEN_SECRET','NbjmkVh9HMTFpNd99dcEyfIuud2SVyHO7FG2gKc2bJkcC');

$access_token = $_SESSION['access_token'];
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
$user = $connection->get("account/verify_credentials");

    $user = $_POST['username'];
    $requested_user_timeline = $connection->get("statuses/user_timeline", ["count" => 10, "screen_name"=>$user ,"exclude_replies" => true]);
    $_SESSION['userTimelineObj'] = $requested_user_timeline;
?>