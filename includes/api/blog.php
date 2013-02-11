<?

function getDirectoryList (){
	    // create an array to hold directory list
	$results = array();
	    // create a handler for the directory
	$handler = opendir("../../pages/posts/");  
	while ($file = readdir($handler)) {
		$pos = strpos($file,".php");
		if($pos == true) {
		//if ($file != "." && $file != ".." && ) {
			$results[] = $file;
		}
	}
	    // tidy up: close the handler
	closedir($handler);
	    // return in reverse order
	rsort($results);
	    // done!
	return $results;
}

function getNumPosts(){
	return count(getDirectoryList());
}

if(isset($_POST["page"])){
	$page = $_POST["page"];
	$return = array();
	
	$postsPerPage = 5;
	$firstPost = ($page - 1) * $postsPerPage;
	$lastPost = $page * $postsPerPage;
	
	$dirList = getDirectoryList();
	
	$return['page'] = $_POST["page"];
	if($page > 1){
		$return['previous'] = true;
	}
	else{
		$return['previous'] = false;
	}
	if(count($dirList) > ($postsPerPage * $page)){
		$return['next'] = true;
	}
	else{
		$return['next'] = false;
	}
	$counter = 0;
	for($i = $firstPost; $i < min(count($dirList),$lastPost); $i++){
		include "../../pages/posts/".$dirList[$i];
		$return['data'][$counter]['date'] = $date;
		$return['data'][$counter]['content'] = $content;
		$return['data'][$counter]['title'] = $title;
		$return['data'][$counter]['url'] = str_replace(".php", "", $dirList[$i]);
		$counter++;
	}
	
	echo json_encode($return);
}

if(isset($_POST["post"])){
	$post = $_POST["post"];
	$return = array();
	
	include "../../pages/posts/".$post.".php";
	$return['date'] = $date;
	$return['content'] = $content;
	$return['title'] = $title;
	$return['url'] = $post;
	
	echo json_encode($return);
}

?>