<?php
    $user = "evanbtcohen";
    $prof = json_decode($facebookService->request('/'.$user));
    $userId = $prof->id;

    $val = $facebookService->request('/'.$user.'/feed?limit=500');
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

    $storyArray = getImportant($storyArray);

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
        echo "<li>".$story["likes"]." likes, type: ".$story["original"]->type."</li>";
    }
    echo "</ul>";

    echo "<br />\n";
    var_dump($types);
    
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
