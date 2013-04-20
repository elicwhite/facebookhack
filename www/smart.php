<?php
#Smart as a mofo

$page_contents = array();

function _generate($template){
	require_once('templates/' . $template . '.php');
}

function _add2page($add){
	global $page_contents;
	array_push($page_contents, $add);
}

#returns contents of page
function _getPageContents(){
	global $page_contents;
	return implode("\n", $page_contents);
}

function redirect2self(){
	$url = $_SERVER['PHP_SELF'];
    header('Location: ' . $url);
}

?>