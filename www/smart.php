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

///var_dump(end(getData('April 2012', 'March 2013', '/evanbtcohen/feed?limit=500')));
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
	//
	while(strtotime((string)(end($result->data)->created_time)) > $start);
	return $data;
}

//loadFriendData('ashish.chandwani');

function loadFriendData($username){
	global $facebookService;
    $prof = json_decode($facebookService->request('/'.$username));
    $userId = $prof->id;

    $val = $facebookService->request('/'.$username.'/feed?limit=500');
    $json = json_decode($val);

    $mutualFriends = json_decode($facebookService->request("me/mutualfriends/".$userId));
    //die(var_dump($mutualFriends->data));
    $mut = array();
    foreach ($mutualFriends->data as $friend) {
        $mut[] = $friend->name;
    }

    $newFriends = array();
    $stories = 0;

    $types = array();
    $storyArray = array();

    foreach($json->data as $ele) {
        //die(var_dump($ele->status_type == "approved_friend"));
        if (property_exists($ele, "status_type") && $ele->status_type == "approved_friend") {
            foreach($ele->story_tags as $tag) {
                if ($tag[0]->id != $userId) {
                   $newFriends[] = $tag[0]->name; 
                }
                
            }
        }
        else
        {
            $likeCount = 0;
            if (property_exists($ele, "likes")) {
                $likeCount = $ele->likes->count;
            }

            $storyArray[] = array("likes" => $likeCount, "original" => $ele);


            if (!isset($types[$ele->type]))
            {
                $types[$ele->type] = 1;
            }
            else
            {
                $types[$ele->type]++;
            }

            //var_dump($ele);
        }
        $stories++;
    }

    usort($storyArray, function ($a, $b) {
        return $a["likes"] < $b["likes"];
    });

    //$storyArray = getImportant($storyArray);

    echo "new mutual friends";
    echo "<ul>";
    $newMutFriends = array_intersect($newFriends, $mut);
    foreach($newMutFriends as $newFriend) {
        echo "<li>".$newFriend."</li>";
    }
    echo "</ul>";
    echo "<br />";
    
    echo "likes in stories";
    echo "<ul>";
    foreach($storyArray as $story) {
        if (property_exists($story["original"], "picture")) {
            echo '<img src="'.$story["original"]->picture.'" />';
        }
        echo "<li>".$story["likes"]." likes, type: ".$story["original"]->type."</li>";
    }
    echo "</ul>";

    echo "<br />\n";
    var_dump($types);
}
    
function getImportant($stories) {
    $avg = array_reduce($stories, function($acc, $item) {
        return $acc + $item["likes"];
    }) / count($stories);

    $distFromAvg = array_map(function($item) use ($avg) {
        $dist = round($item["likes"] - $avg);
        return $dist;
    }, $stories);

    $stdDev = sqrt(array_sum($distFromAvg) / count($stories));

    $results = array_filter($stories, function($item) use ($avg, $stdDev){
        return $item["likes"] > $avg+$stdDev;
    });

    return $results;
}

?>