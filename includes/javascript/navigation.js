var selected = "";
var selectedTitle = "";
var timer;
var slideshowTimer;
var hash = location.hash;

setInterval(function()
{
    if (location.hash != hash)
    {
        hash = location.hash;
        loadPage(hash.replace("#",""));
    }
}, 100);


/*
* Look in the pages/ directory to try and find the page. If it can't load it, it'll wait 5 seconds before trying again.
*/
function loadPage(requestedPage){
	doAnimations(requestedPage); // Carry out page animations and class re-allocation
	clearTimeout(timer);
	clearTimeout(slideshowTimer); // Ensure that the slides on homepage stop turning after moving to a new page
	$("#loading").fadeIn(200, function(){});
	$("#content").fadeOut(200, function(){
			$.ajax({
				type : 'POST',
				url : 'includes/router.php',
				dataType : 'html',
				data : {
					requested: requestedPage
				},
				success : function(data){
					$("#content").html(data);
					$("#loading").fadeOut(200, function(){
						$("#content").fadeIn(600, function(){});
					});
					
					$("html, body").animate({ scrollTop: 0 }, "fast");
					//analytics();
					reloadEffects();
				},
				error : function(XMLHttpRequest, textStatus, errorThrown){
					timer = setTimeout(function(){loadPage(requestedPage)}, 5000);
					console.log("error");
				}
			});
	});
}

/*
* Handle animations for next page
*/
function doAnimations(requestedPage){	
	$("nav a").removeClass("selected");
	$("nav a").addClass("unselected");
	if(requestedPage == "home" || requestedPage == ""){
		requestedPage = "home";
	}

	// If requestedPage doesn't contain a "/" and id of reqtestedPage exists...
	if((requestedPage.indexOf("/") == -1) && ($("#"+requestedPage).length > 0)){ 
		if(requestedPage == "home"){
			$("#home").animate({top: '2px'}, 600, "easeOutQuint");
		}
		else{
			$("#home").animate({top: '-5px'}, 500, "easeOutQuint");
		}
		var selectedItem = $("#"+requestedPage);
			
		selectedItem.addClass("selected");
		selectedItem.removeClass("unselected");
		selectedItem.animate({color: "#00BFFF"}, 1200);
		
		$("title").html("Will W - "+requestedPage);
		
		//var position = selectedItem.position().left + selectedItem.outerWidth()*0.5;	
		var position = selectedItem.position().left + selectedItem.innerWidth()*0.5;	
		$("nav .arrow .head").animate({left: position-5}, 1200, "easeOutQuint");
		$("nav .arrow .line").animate({width: (position)}, 1200, "easeOutQuint");
			

	}
	else{
		setNullPointer();
		$("title").html("Will Webberley");
	}
	
	$("nav a.unselected").animate({color: "white"}, 1200);
}

function setNullPointer(){
	if(hash != ""){
		var position = -10;
		$("nav .arrow .head").animate({left: position}, 1200, "easeOutQuint");
		$("nav .arrow .line").animate({width: (position+5)}, 1200, "easeOutQuint");
	}
}

$(".banner").mouseenter(function(){
	$(this).animate({top: "-7px"}, 300, "easeOutQuint");
	//$(this).animate({top: "-40px"}, 300, "easeOutQuint");
});
$(".banner").mouseleave(function(){
	$(this).animate({top: "-24px"}, 300, "easeOutQuint");
	//$(this).animate({top: "-65px"}, 300, "easeOutQuint");
});

$(".fader").mouseenter(function(){
	$(this).animate({backgroundColor: "rgba(200,200,200,0.2)"}, 150);
});
$(".fader").mouseleave(function(){
	$(this).animate({backgroundColor: "rgba(250,250,250,0)"}, 300);
});
$("nav a").click(function(){
	$(this).animate({backgroundColor: "rgba(250,250,250,0)"}, 300);
});


function startPage(requested){
	/*
	* Calculate the required page
	*/
	//var requested = window.location.hash;
	//console.log(requested);
	while(requested.substr(-1) == '/') {
		// If request ends with a slash, remove it, and keep removing them until there are none
        	requested = requested.substr(0, requested.length - 1);
    	}
    	
	var pageToFetch = ""; // To hold the actual web page to get
	var strippedRequested = requested.replace("#",""); // Remove the # from the page
	var pageFound = 0; // Increment if a suitable page has been found
	
	/*
	* (first check if it contains a "/" since this will return an error if not)
	*/
	if(strippedRequested.indexOf("/") == -1){
		if($("#"+strippedRequested).length > 0){
			pageToFetch = strippedRequested;
			pageFound += 1;
		}
		if(strippedRequested == ""){
			pageToFetch = "";
			pageFound += 1;
		}
	}
	
	/* 
	* If we still have not found the page, hand it to the router to try and sort out, and return a 404 if not
	*/
	if(pageFound == 0){
		pageToFetch = strippedRequested;
	}

	/*
	* Finally request the page
	*/
	loadPage(pageToFetch);

}