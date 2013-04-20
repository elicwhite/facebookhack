<?php
#Smart as a mofo

$page_contents = array();

function _generate($template){
    global $PAGE_VARS;
	require_once('templates/' . $template . '.php');
}

function _condIns($var){
    global $PAGE_VARS;
    if(!isset($PAGE_VARS[$var])){
        return "";
    }
    return $PAGE_VARS[$var];
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

function Truncate($string, $length, $stopanywhere=false) {
    //truncates a string to a certain char length, stopping on a word if not specified otherwise.
    if (strlen($string) > $length) {
        //limit hit!
        $string = substr($string,0,($length -3));
        if ($stopanywhere) {
            //stop anywhere
            $string .= '...';
        } else{
            //stop on a word.
            $string = substr($string,0,strrpos($string,' ')).'...';
        }
    }
    return $string;
}