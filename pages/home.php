<div id="profile">
	<div id="info">
	<img src="../media/will.jpg" alt="Me!" />
	<p>
	<strong>Hi, I'm Will</strong>, and I'm based in Cardiff in the UK. </p>
	<p>
	I am currently doing a PhD in computer science (mobile and social nets) at <a href="http://cf.ac.uk" target="_blank">Cardiff University</a>. 
	See <a href="#research">research</a> for more information on this!</p>
	
	<hr />
	
	<button id="prev-post">prev</button><button id="scroll-top">top</button>
	<button id="next-post">next</button>
	
	<div class="clear"></div>
	<hr />
	<div id="page-no"></div>
	</div>
</div>

<div id="full-image" style="display:none; position:fixed; z-index:100;"></div>
<div id="blog">
	<p>Loading...</p>
</div>

<script type="text/javascript">
var page = 1;
var currentPost = 0;
var postsOnPage = 0;
var imageShown = false;

function embedPost(i, title, content, date, url){
	$("#blog").append('<article id="'+i+'"><div class="date">'+date+'</div><div class="title"><a href="#post/'+url+'">'+title+'</a></div><p class="content">'+content+'</p></article>');
}

function addNavigation(prev, next){
	$(".prev-page").css({'opacity':'0.0'});
	$(".next-page").css({'opacity':'0.0'});
	if(prev == true && next == true){
		$("#blog").append('<p><button class="prev-page">Newer</button><button class="next-page">Older</button></p>');
		$(".prev-page").css({'opacity':'1.0'});
		$(".next-page").css({'opacity':'1.0'});
		return;
	}
	if(prev == true){
		$("#blog").append('<p><button class="prev-page">Newer</button></p>');
		$(".prev-page").css({'opacity':'1.0'});
	}
	if(next == true){
		$("#blog").append('<p><button class="next-page">Older</button></p>');
		$(".next-page").css({'opacity':'1.0'});
	}
}

function resizeComponents(){
	<?
	require_once "../includes/mobile.php";
	$detect = new Mobile_Detect;
	if(!$detect->isMobile() & !$detect->isTablet()){ ?>
		if($(window).width() < 700){
			$("#profile").css({'width':'400px'});
			$("#profile").css({'float':'left'});
			$("#profile #info").css({'position':'relative'});
			$("#profile #info").css({'width':$("#profile").width()});
			$("#profile img").css({'width':'180px', 'margin-right':'15px'});
		}
		else{
			$("#profile").css({'width':'20%'});
			$("#profile").css({'float':'right'});
			$("#profile #info").css({'position':'fixed'});
			$("#profile #info").css({'width':'20%'});
			$("#profile img").css({'width':'100%', 'margin-right':'0px'});
		}
	<? } ?>
}

function handleScrolling(){
	$("#scroll-top").click(function(){
		 $("html, body").animate({ scrollTop: 0 }, "slow");
		 currentPost = 0;
	});
	$(document).scroll(function() {
		if ($(document).scrollTop() >= 100) {
			$("#scroll-top").css({'opacity':'1.0'});
		} 
		else 
		{
	    		$("#scroll-top").css({'opacity':'0.0'});
	  	}
	});
	$('html, body').animate({
         	scrollTop: $("#0").offset().top-85
     	}, 1000);
}

function scrollToPost(nextBool){
     	var scrollPosition = $(document).scrollTop();
	var nextPost;
	var thisPosition = 0;
	$("article").each(function() {
		thisPost = $(this);
		thisPosition = thisPost.offset().top-85;
		if (thisPosition > scrollPosition) {
			if(nextBool){
		        	nextPost = thisPost;
		        }
		        else{
		        	nextPost = thisPost.prev("article");
		        }
		        return false; 
		}
		if (thisPosition == scrollPosition) {
			if(nextBool){
		        	nextPost = thisPost.next("article");
		        }
		        else{
		        	nextPost = thisPost.prev("article");
		        }
		        return false; 
		}
	});
	$('html, body').animate({
         	scrollTop: nextPost.offset().top-85
     	}, 500);
}

function refreshListeners(){
	$(".next-page").click(function(){
		page = page +1;
		$("#blog").html("");
		window.location="http://www.willwebberley.net/#page/"+page;
	});
	$(".prev-page").click(function(){
		page = page -1;
		$("#blog").html("");
		if (page > 1){
			window.location="http://www.willwebberley.net/#page/"+page;
		}
		if(page == 1){
			window.location="http://www.willwebberley.net/#";
		}
	});
	$("#prev-post").click(function(){
		scrollToPost(false);
	});
	$("#next-post").click(function(){
		scrollToPost(true);
	});
	
	$(".blog-image").click(function(){
		if(!imageShown){
			$("#full-image").html('<img src="http://willwebberley.net/'+$(this).attr("src")+'" style="max-width:95%; max-height:700px; position:relative; margin:0px auto; cursor:pointer;"/>');
			$("#full-image").css({'width':$("#blog").width()});
			//$("#full-image").css({'height':$("#blog").height()});
			$("#blog").animate({opacity: '0.3'},500, function(){});
			$("#full-image").fadeIn('slow');
			imageShown = true;
			refreshListeners();
		}
	});
	$("#full-image img").click(function(){
		if(imageShown){
			$("#full-image").fadeOut('fast', function(){
				$("#blog").animate({opacity: '1.0'},300, function(){});
				$("#full-image").html('');
			});
			imageShown = false;
		}
	});
	$(window).resize(function() {
		resizeComponents();
	});
	resizeComponents();
	
	$("#next").css({'cursor':'pointer'});
	$("#prev").css({'cursor':'pointer'});
}



function getPosts(pageNo){
	$("#blog").html("<p>Loading blog...</p>");
	$.ajax({
				type : 'POST',
				url : '../includes/api/blog.php',
				dataType : 'json',
				data : {
					page: pageNo
				},
				success : function(data){
					$("#blog").html("");
					if(!data['data']){
						$('#blog').html('<h2>That page of posts could not be found.</h2>');
						return;
					}
					for(var i = 0; i < data['data'].length; i++){
						embedPost(i, data['data'][i]['title'],data['data'][i]['content'],data['data'][i]['date'],data['data'][i]['url']);
					}
					if(data['previous'] == true || data['next'] == true){
						addNavigation(data['previous'], data['next']);
					}
					postsOnPage = data['data'].length - 1;
					refreshListeners();
					$("html, body").animate({ scrollTop: 0 }, "fast");
					$("title").html("Will W - blog");
					$("#prev-post").animate({opacity: '1.0'}, 1000);
					$("#next-post").animate({opacity: '1.0'}, 1000);
					$("#page-no").html('<h2>Page '+data['page']+'</h2>');
					handleScrolling();
					console.log("loaded page "+pageNo);
				},
				error : function(XMLHttpRequest, textStatus, errorThrown){
					console.log(textStatus);
				}
			});
}

function getPost(postUrl){
	console.log("loading post "+postUrl);
	$("#blog").html("<p>Loading post...</p>");
	$.ajax({
				type : 'POST',
				url : '../includes/api/blog.php',
				dataType : 'json',
				data : {
					post: postUrl
				},
				success : function(data){
					$("#blog").html("");
					embedPost(0, data['title'],data['content'],data['date'],data['url']);
					$("html, body").animate({ scrollTop: 0 }, "fast");
					refreshListeners();
					$("title").html(data['title']);
					$("#prev-post").animate({opacity: '0.0'}, 1000);
					$("#next-post").animate({opacity: '0.0'}, 1000);
					$(".prev-page").css({'opacity': '0.0'});
					$(".next-page").css({'opacity': '0.0'});
					$("#page-no").html();
					handleScrolling();
					console.log("loaded post "+postUrl);
				},
				error : function(XMLHttpRequest, textStatus, errorThrown){
					console.log(textStatus);
				}
			});
}

$(document).ready(function(){
	<?
	$chosen = 0;
	if(isset($post)){
		echo "getPost('$post');";
		$chosen += 1;
		//exit();
	}
	if(isset($page) & $chosen == 0){
		echo "getPosts(".$page.");";
		echo "page = ".$page.";";
		$chosen += 1;
		//exit();
	}
	if($chosen  == 0){
		echo "getPosts(1);";
		echo "page = 1;";
	}
	?>
});
</script>