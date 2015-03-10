<?php

require_once '../_php/vendor/twitter/twitter.class.php';

// enables caching (path must exists and must be writable!)
Twitter::$cacheDir = dirname(__FILE__) . '/temp';

// see credentials.txt

$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

//$statuses = $twitter->search("#thinkwatson");
$statuses = $twitter->load(Twitter::REPLIES));

date_default_timezone_set('America/Los_Angeles');

?>


<?php
foreach ($statuses as $status):
//echo "<a href='http://twitter.com/datadreamer/status/{$status->id_str}'>";
echo "<a href='http://twitter.com/" . $status->user->screen_name . "/status/" . $status->id_str . "'>";
echo $status->text ."</a><br/>";
echo "@" . $status->user->screen_name ."<br/><br/>";
?>

<?php
endforeach
?>
