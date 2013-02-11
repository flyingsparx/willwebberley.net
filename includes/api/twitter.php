<?
 
     
    // Here's the Science - futher comments can be found below
    function changeLink($string, $tags=false, $nofollow, $target){
      if(!$tags){
       $string = strip_tags($string);
      } else {
       if($target){
        $string = str_replace("<a", "<a target=\"_blank\"", $string);
       }
       if($nofollow){
        $string = str_replace("<a", "<a rel=\"nofollow\"", $string);
       }
      }
      return $string;
     }
     
     function getLatestTweet($xml, $tags=false, $nofollow=true, $target=true,$widget=false){
        global $twitterid;
      $xmlDoc = new DOMDocument();
      $xmlDoc->load($xml);
     
      $x = $xmlDoc->getElementsByTagName("entry");
     
      $tweets = array();
      foreach($x as $item){
       $tweet = array();
     
       if($item->childNodes->length)
       {
        foreach($item->childNodes as $i){
         $tweet[$i->nodeName] = $i->nodeValue;
        }
       }
        $tweets[] = $tweet;
      }
     
      $return = array();
      
      foreach($tweets as $tweettag){
       $tweetdate = $tweettag["published"];
       $tweet = $tweettag["content"];
       $timedate = explode("T",$tweetdate);
       $date = $timedate[0];
       $time = substr($timedate[1],0, -1);
       $tweettime = (strtotime($date." ".$time))+3600; // This is the value of the time difference - UK + 1 hours (3600 seconds)
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
        $return['tweets'][] = changeLink($tweet, $tags, $nofollow, $target);
        $return['times'][] = $timemessage;

       }
       return $return;         
     }
     
     function getTweets(){
	    $twitterid = "flyingSparx";
	    $numberoftweets = "7";
	    $tags = true;
	    $nofollow = true;
	    $target = true;
	    $widget = true;
     	 $tweetxml = "http://search.twitter.com/search.atom?q=from:" . $twitterid . "&rpp=" . $numberoftweets . "";
        $tweet_array = getLatestTweet($tweetxml, $tags, $nofollow, $target, $widget);
        return $tweet_array;
     }
     
function startsWith($haystack, $needle){
    return strpos($haystack, $needle) === 0;
}
     
$tweets = getTweets();

/*
$strippedTweets = array();
$counter = 0;
for ($i = 0; $i < 20; $i++){
	if(!startsWith($tweets['tweets'][$i], "@")){
		$strippedTweets['tweets'][$counter] = $tweets['tweets'][$i];
		$strippedTweets['times'][$counter] = $tweets['times'][$i];
		$counter++;
	}
	if($counter == 6){
		break;	
	}
}
*/

for ($i = 0; $i < count($tweets['tweets']); $i++){
	if($i < 6){
		echo '<li class="item">'.$tweets['tweets'][$i].'<br />';
		echo '<span class="time">'.$tweets['times'][$i].'</span></li>';
	}
}
       
        
?>