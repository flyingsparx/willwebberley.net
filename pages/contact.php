<h1>How to get hold of me</h1>

<div class="column">
	<h2>Email</h2>
	<p><label class="email-label">Academic</label>
		<a href="mailto:W.M.Webberley@cs.cf.ac.uk" target="_blank" >
		W.M.Webberley@cs.cf.ac.uk</a>
	</p>
	<br />
	<p><label class="email-label">General</label>
		<a href="mailto:will@willwebberley.net" target="_blank" >
		will@willwebberley.net</a>
	</p>
	
	<h2>Social Networks</h2>
	<p>I'm also available on a variety of different social networking websites. Please use the links at the top of the 
	page for this.</p>
</div>

<div class="column right">
	<h2>Complete the form</h2>
	<p class="hidden error" id="form-error"></p>
	<p class="hidden success" id="form-success">Your message was successfully sent. Thank you!</p>
	<p><label class="edit-label">Your name</label><input type="text" id="name" /></p>
	<p><label class="edit-label">Your email</label><input type="text" id="email" /></p>
	<p><label class="edit-label">Your message</label><textarea id="message"></textarea></p>
	<p><label>&nbsp;</label><button id="send" class="send-button">Send message</button></p>
	
</div>

<?
	require_once "../includes/mobile.php";
	$detect = new Mobile_Detect;
	if(!$detect->isMobile() & !$detect->isTablet()){?>
<div id="news">
	<div id="twitterfeed" class="feed">	
		<h2 class="feedlink">Recent tweets</h2>
		<p class="load-text"><strong><br /><br /><br /><br />Loading tweets...</strong></p>	
		<ul>

		</ul>
	</div>
	<div id="lastfmfeed" class="feed">
		<h2 class="feedlink">Recent plays</h2>
		<p class="load-text"><strong><br /><br /><br /><br />Loading tracks...</strong></p>
		<ul>

   		</ul>
   	</div>
   	<!--
   	<div id="photofeed" class="feed">
		<h2 class="feedlink">Recent photos</h2>
		<p class="load-text"><strong><br /><br /><br /><br />Loading photos...</strong></p>
		<ul>

   		</ul>
   	</div>
   	-->
	<span id="twitterlink" class="feedlink">
		<a href="http://twitter.com/flyingSparx" target="_blank"><img src="media/twitter-feed.png" alt="flyingSparx on Twitter" /> @flyingSparx</a>
	</span>
  	<span id="lastfmlink" class="feedlink">
		<a href="http://last.fm/user/flyingsparks" target="_blank"><img src="media/lastfm-feed.png" alt="flyingsparks on Last.fm" /> flyingsparks</a>
	</span>
	<!--
	<span id="photolink" class="feedlink">
		<a href="https://plus.google.com/u/0/117295241444122869150/photos" target="_blank"><img src="media/picasa-feed.png" alt="Picasa web albums" /> Picasa</a>
	</span>
	-->
</div>
<?}?>

<script type="text/javascript">

var showedTracksYet = false;
var showedPhotosYet = false;
function showTwitter(){
	$("#photofeed").animate({opacity:'0.0'}, 600, function(){});
	$("#photofeed").css({'z-index':'4'});
	$("#lastfmfeed").animate({opacity:'0.0'}, 600, function(){});
	$("#lastfmfeed").animate({'z-index':'4'});
	
	$("#twitterfeed").animate({opacity:'1.0'}, 600, function(){});
	$("#twitterfeed").css({'z-index':'6'});
	
	$("#lastfmlink").animate({opacity: "0.5", backgroundColor:"rgba(0,0,0,0.0)"}, 300, function(){});
	$("#photolink").animate({opacity: "0.5", backgroundColor:"rgba(0,0,0,0.0)"}, 600, function(){});
	$("#twitterlink").animate({opacity: "1.0", backgroundColor:"rgba(0,0,0,0.05)"}, 600, function(){});
	
	$(".feed .item").animate({opacity:"1.0"}, 100, function(){});
}

$("#twitterlink").mouseenter(function(){
	showTwitter();
});
$("#lastfmlink").mouseenter(function(){
	if(!showedTracksYet){
		fetchTracks();
	}
	showedTracksYet = true;
	$("#photofeed").animate({opacity:'0.0'}, 600, function(){});
	$("#photofeed").css({'z-index':'4'});
	$("#twitterfeed").animate({opacity:'0.0'}, 600, function(){});
	$("#twitterfeed").css({'z-index':'4'});
	
	$("#lastfmfeed").css({'z-index':'6'});
	$("#lastfmfeed").animate({opacity:'1.0'}, 600, function(){});
	
	$("#twitterlink").animate({opacity: "0.5", backgroundColor:"rgba(0,0,0,0.0)"}, 300, function(){});
	$("#photolink").animate({opacity: "0.5", backgroundColor:"rgba(0,0,0,0.0)"}, 600, function(){});
	$("#lastfmlink").animate({opacity: "1.0", backgroundColor:"rgba(0,0,0,0.05)"}, 600, function(){});
	
	$(".feed .item").animate({opacity:"1.0"}, 100, function(){});
});

$("#photolink").mouseenter(function(){
	if(!showedPhotosYet){
		fetchPhotos();
	}
	showedPhotosYet = true;
	$("#lastfmfeed").animate({opacity:'0.0'}, 600, function(){});
	$("#twitterfeed").animate({opacity:'0.0'}, 600, function(){});
	$("#twitterfeed").css({'z-index':'4'});
	$("#lastfmfeed").css({'z-index':'4'});
	
	$("#photofeed").animate({opacity:'1.0'}, 600, function(){});
	$("#photofeed").css({'z-index':'6'});
	
	$("#twitterlink").animate({opacity: "0.5", backgroundColor:"rgba(0,0,0,0.0)"}, 300, function(){});
	$("#lastfmlink").animate({opacity: "0.5", backgroundColor:"rgba(0,0,0,0.0)"}, 600, function(){});
	$("#photolink").animate({opacity: "1.0", backgroundColor:"rgba(0,0,0,0.05)"}, 600, function(){});
	
	$(".feed .item").animate({opacity:"1.0"}, 100, function(){});
});

$("button").mouseenter(function(){
		$(this).animate({backgroundColor: "rgba(0,0,0,0.8)", color: "white"}, 150);
	});
	$("button").mouseleave(function(){
		$(this).animate({backgroundColor: "white", color: "#222222"}, 150);
	});

function fetchTweets(){
	$.ajax({
		type : 'POST',
		url : '../includes/api/twitter.php',
		dataType : 'html',
		success : function(data){
			$("#twitterfeed .load-text").fadeOut(400, function(){
				$("#twitterfeed ul").html(data);
				$("#twitterfeed ul").animate({opacity:"1.0"}, 400, function(){});
			});
		},
		error : function(XMLHttpRequest, textStatus, errorThrown){
			$("#twitterfeed .load-text").html("Still loading tweets... (Unable to make connection)");
			timer = setTimeout(function(){fetchTweets()}, 5000);
			console.log("error");
		}
	});
}

function fetchTracks(){
	$.ajax({
		type : 'POST',
		url : '../includes/api/lastfm.php',
		dataType : 'html',
		success : function(data){
			$("#lastfmfeed .load-text").fadeOut(400, function(){
				$("#lastfmfeed ul").html(data);
				$("#lastfmfeed ul").animate({opacity:"1.0"}, 400, function(){});
			});
		},
		error : function(XMLHttpRequest, textStatus, errorThrown){
			$("#lastfmfeed .load-text").html("Still loading tracks... (Unable to make connection)");
			timer = setTimeout(function(){fetchTracks()}, 5000);
			console.log("error");
		}
	});
}

function fetchPhotos(){
	$.ajax({
		type : 'POST',
		url : '../includes/api/picasa.php',
		dataType : 'html',
		success : function(data){
			$("#photofeed .load-text").fadeOut(400, function(){
				$("#photofeed ul").html(data);
				$("#photofeed ul").animate({opacity:"1.0"}, 400, function(){});
			});
		},
		error : function(XMLHttpRequest, textStatus, errorThrown){
			$("#lastfmfeed .load-text").html("Still loading photos... (Unable to make connection)");
			timer = setTimeout(function(){fetchPhotos()}, 5000);
			console.log("error");
		}
	});
}

$("#send").click(function(){
	$("input").css("border", "gray 1px solid");
	$("textarea").css("border", "gray 1px solid");
	$("#send").animate({opacity: '0.0'}, 100, function(){
		$("#form-error").slideUp(300, function(){
			$("#form-error").html('');
			$.ajax({
				type : 'POST',
				url : 'includes/send-email.php',
				dataType : 'json',
				data : {
					name : $("#name").val(),
					email : $("#email").val(),
					message : $("#message").val()
				},
				success : function(data){
					if(data.error == 0){
						$("#form-success").slideDown(100, function(){});
					}
					else{
						$("#send").animate({opacity: '1.0'}, 100, function(){});
						$("#form-error").html(data.html);
						$("#form-error").slideDown(300, function(){});
						$(data.culprit).css("border", "red 1px solid");
					}
				},
				error : function(XMLHttpRequest, textStatus, errorThrown){
					console.log(textStatus);
				}
			});
		});
	});
});

$(document).ready(function(){
	$(".feed ul").css({"opacity": "0.0"});
    	showTwitter();
    	fetchTweets();
  });

</script>
	