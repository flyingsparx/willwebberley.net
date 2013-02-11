<?
/*** MAIN CODE ***/

$requestedPage = $_POST["requested"];
/*
* $requestedPage represents the text following the www.willwebberley.net/#
*/


/*
* If there is nothing appended to the willwebberley.net/# main domain, then show the 
* home page (i.e. blog page 1) and then exit.
*/
if(strcmp($requestedPage,"") == 0){
	include "../pages/home.php";
	echo '<script>doAnimations("home");</script>';
	exit();
}

/* 
* If there is more after the domain, strip out slashes and put path into array
*/
$exploded = explode("/",$requestedPage);

/*
* If the first part of the path = 'tutorials', load the appropriate tutorial 
* from the second part of the path (in /pages/tutorials/)
*/
if(strcmp($exploded[0], "tutorials") == 0){
	if(count($exploded) ==  2){
		include "../pages/tutorials/".$exploded[1].".php";
	}
	if(count($exploded) >  2 || count($exploded) == 1){
		echo '<h1>We could not find that tutorial, sorry!</h1>';
	}
}

/*
* If the first part of the path = 'post', load the home page, but set
* the variable $post to equal the second part of the path. The homepage will then handle
* the loading of the appropriate post from /pages/posts/ (using /includes/api/blog.php)
*/
else if(strcmp($exploded[0], "post") == 0){
	if(count($exploded) ==  2){
		$post = str_replace(".php", "", $exploded[1]);
		include("../pages/home.php");
		echo '<script>doAnimations("home");</script>';
	}
	if(count($exploded) >  2 || count($exploded) == 1){
		echo '<h1>We could not find that post, sorry!</h1>';
	}
}

/*
* If the first part of the path = 'page', load the home page, but set
* the variable $page to equal the second part of the path. The homepage will then handle
* the loading of the appropriate page of posts (using /includes/api/blog.php)
*/
else if(strcmp($exploded[0], "page") == 0){
	if(count($exploded) ==  2){
		$page = str_replace(".php", "", $exploded[1]);
		include("../pages/home.php");
		echo '<script>doAnimations("home");</script>';
	}
	if(count($exploded) >  2 || count($exploded) == 1){
		echo '<h1>We could not find that page, sorry!</h1>';
	}
}

/*
* Otherwise, if there is a file in the filysystem equal to /pages/path1/path2/etc., then
* load that page (e.g. going to willwebberley.net/#contact will load /pages/contact. If a 
* page cannot be found by this stage, then a 404 error is shown.
*/
else{
	if(file_exists("../pages/".$requestedPage.".php")){
		include "../pages/".$requestedPage.".php";
	}
	if(!file_exists("../pages/".$requestedPage.".php")){
		include "../pages/404.php";
	}
}


?>