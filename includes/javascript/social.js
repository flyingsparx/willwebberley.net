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

function fetchTweets(){
	$.ajax({
		type : 'POST',
		url : '../includes/api/twitter.php',
		dataType : 'html',
		success : function(data){
			$("#twitterfeed .load-text").fadeOut(400, function(){
				$("#twitterfeed ul").html(data);
				$("#twitterfeed ul").animate({opacity:"1.0"}, 400, function(){});
				updateListeners();
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
				updateListeners();
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
				updateListeners();
			});
		},
		error : function(XMLHttpRequest, textStatus, errorThrown){
			$("#lastfmfeed .load-text").html("Still loading photos... (Unable to make connection)");
			timer = setTimeout(function(){fetchPhotos()}, 5000);
			console.log("error");
		}
	});
}