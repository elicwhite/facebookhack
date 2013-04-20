<?php
    $user = "evanbtcohen";
    $prof = json_decode($facebookService->request('/'.$user));
    $userId = $prof->id;

    $val = $facebookService->request('/'.$user.'/feed');
    $json = json_decode($val);

    $newFriends = array();
    $stories = 0;

    foreach($json->data as $ele) {
        //die(var_dump($ele->status_type == "approved_friend"));
        if (property_exists($ele, "status_type") && $ele->status_type == "approved_friend") {
            foreach($ele->story_tags as $tag) {
                if ($tag[0]->id != $userId) {
                   $newFriends[] = $tag[0]->name; 
                }
                
            }
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
    echo count($newFriends)." new friends in the last $stories stories";
    
?>
