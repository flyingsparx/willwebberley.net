<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Will Webberley - computer science PhD student at Cardiff University">
	<meta name="author" content="Will Webberley">
	
	<title>Will Webberley</title>
	
	<link rel="icon" type="image/png" href="media/favicon.png">
	<link href='http://fonts.googleapis.com/css?family=Press+Start+2P' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Quantico' rel='stylesheet' type='text/css'>	
	<link href='http://fonts.googleapis.com/css?family=Molle:400italic' rel='stylesheet' type='text/css'>
	<link href="http://www.willwebberley.net/includes/css/main-styles.css" rel="stylesheet" type="text/css"/>
	<? 
	/* If mobile device, load mobile stylesheet */
	require_once "includes/mobile.php";
	$detect = new Mobile_Detect;
	if($detect->isMobile() || $detect->isTablet()){
		echo '<link href="http://www.willwebberley.net/includes/css/mobile-styles.css" rel="stylesheet" type="text/css"/>';
	}
	?>
	
</head>

<body>

<header>
	<a href="http://www.twitter.com/flyingSparx" target="_blank">
		<img src="media/twitter-banner.png" class="twitter-banner banner" alt="Twitter" />
	</a>
	<a href="https://plus.google.com/117295241444122869150" target="_blank">
		<img src="media/google-banner.png" class="google-banner banner" alt="Google Plus" />
	</a>
	<a href="http://www.last.fm/user/flyingsparks" target="_blank">
		<img src="media/lastfm-banner.png" class="lastfm-banner banner" alt="Last FM" />
	</a>
	<a href="http://www.github.com/flyingsparx" target="_blank">
		<img src="media/github-banner.png" class="github-banner banner" alt="Github" />
	</a>
	<a href="http://www.foursquare.com/flyingsparx" target="_blank">
		<img src="media/foursquare-banner.png" class="foursquare-banner banner" alt="Foursqaure" />
	</a>
	<a href="http://www.facebook.com/willwebberley" target="_blank">
		<img src="media/facebook-banner.png" class="facebook-banner banner" alt="Facebook" />
	</a>
	<nav>
		<div class="arrow">
			<div class="line"></div>
			<div class="head"></div>	
		</div>
		<a href="http://www.willwebberley.net/#" id="home">Will Webberley</a>
		<a href="http://www.willwebberley.net/#research" class="fader" id="research">Research</a>
		<a href="http://www.willwebberley.net/#outputs" class="fader" id="outputs">Outputs</a>
		<a href="http://www.willwebberley.net/#teaching" class="fader" id="teaching">Teaching</a>
		<a href="http://www.willwebberley.net/#contact" class="fader" id="contact">Contact</a>
		<a href="http://www.willwebberley.net/#cv" class="fader" id="cv">CV</a>
	</nav>
</header>

<?
/* If browser is old, display a warning message */
include('includes/browser.php');
if(oldBrowser() == 1){
	echo '<div id="browser-error">';
		echo '<p class="subject">Ouch...</p>';
		echo '<p class="text">Looks like you\'re using an outdated or non-standards-compliant web-browser, so this site probably won\'t behave or look as it should.</p>';
		echo '<p class="text">For the sake of your general web experience and security, give <a href="https://www.google.com/intl/en/chrome/browser/" target="_blank">Google Chrome</a> a go instead. </p>';
	echo '</div>';
}
?>

<div id="main-stuff">	
	<div id="loading"><img src="media/loading.gif" alt="Loading" /></div>
	<div id="content"></div>
	<div class="clear"></div>	
</div>

<footer></footer>
	
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="http://gsgd.co.uk/sandbox/jquery/easing/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="http://code.jquery.com/color/jquery.color-2.1.0.js"></script>

<script type="text/javascript" src="includes/javascript/navigation.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		startPage(window.location.hash);
	});
</script>

</body>
</html>