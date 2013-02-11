<?
function getTracks(){
	$tracks=  simplexml_load_file("http://ws.audioscrobbler.com/1.0/user/flyingsparks/recenttracks.rss");
	$songs = $tracks->channel;	
	return $songs;
}

$tracks= getTracks();
//for ($i = 0; $i < count($tracks->item); $i++){
for ($i = 0; $i < 6; $i++){
	echo '<li class="item"><a href="'.$tracks->item[$i]->link.'" target="_blank">'.$tracks->item[$i]->title.'</a><br />';
   	$tweettime =strtotime($tracks->item[$i]->pubDate); // This is the value of the time difference - UK + 1 hours (3600 seconds)
	$nowtime = time();
	$timeago = ($nowtime-$tweettime);
	$thehours = floor($timeago/3600);
	$theminutes = floor($timeago/60);
	$thedays = floor($timeago/86400);
	if($theminutes < 60){
		if($theminutes < 1){
			$timemessage =  "Less than 1 minute ago";
		} else if($theminutes == 1) {
		         $timemessage = $theminutes." minute ago";
		} else {
		         $timemessage = $theminutes." minutes ago";
		}
	} else if($theminutes > 60 && $thedays < 1){
	         if($thehours == 1){
		         $timemessage = $thehours." hour ago";
	         } else {
		         $timemessage = $thehours." hours ago";
	         }
	} else {
	         if($thedays == 1){
		         $timemessage = $thedays." day ago";
	         } else {
		         $timemessage = $thedays." days ago";
	         }
	}
   	echo '<span class="time">'.$timemessage .'</span></li>';
}
?>