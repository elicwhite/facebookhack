<?php
    $user = "evanbtcohen";
    $prof = json_decode($facebookService->request('/'.$user));
    $userId = $prof->id;

    $val = $facebookService->request('/'.$user.'/feed?limit=500');
    $json = json_decode($val);

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

    echo "new friends";
    echo "<ul>";
    foreach($newFriends as $newFriend) {
        echo "<li>".$newFriend."</li>";
    }
    echo "</ul>";
    echo "<br />";
    
    echo "likes in stories";
    echo "<ul>";
    foreach($storyArray as $story) {
        echo "<li>".$story["likes"]." likes, type: ".$story["original"]->type."</li>";
    }
    echo "</ul>";

    echo "<br />\n";
    var_dump($types);
    
?>
