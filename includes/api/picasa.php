<?
$userID = "117295241444122869150";
$feed = simplexml_load_file("https://picasaweb.google.com/data/feed/api/user/".$userID."?kind=photo&max-results=8");
for ($i = 0; $i < 8; $i++){
	$element = $feed->entry[$i]->content;	
	
	$var = $element->attributes();
	$url = $var->src;

	echo '<li class="item"><a href="'.$url.'" target="_blank"><img src="'.$url.'" height="96px"/></a><br /></li>';
}
?>