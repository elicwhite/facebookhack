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

//dont die
//die(var_dump($facebookService));
//var_dump($facebookService->request('https://graph.facebook.com/1032810646/feed?limit=25&until=1363574824'));

var_dump(getData('April 2012', 'March 2013', '/evanbtcohen/feed'));
/*
 * Next level data function. Terrible comment.
 * getData("Yesterday at 3pm", "March 12th 2012", "/evanbtcohen/feed");
*/
function getData($start, $end, $query) {
	global $facebookService;
	$data = array();
	$start = strtotime($start);
	$end = strtotime($end);
	do{
		$result = json_decode($facebookService->request($query));
		if (!count($result->data)) {
			break;
		}
		$data = array_merge($data, $result->data);
		if(property_exists($result, "paging") && property_exists($result->paging, "next")){
			$query = $result->paging->next;
		}
	}
	while(strtotime((string)(end($result->data)->created_time)) > $start);
	return $data;
}

function epicPaginationAsFuck($fbObject, $depth = 1){
	paginateObject($fbObject, $depth);
}

function paginateObject($fbObject, $depth = 1){

}

?>