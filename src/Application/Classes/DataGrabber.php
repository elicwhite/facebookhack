<?php
namespace Application\Classes;

class DataGrabber
{
    private $service;

    public function __construct($service){
        $this->service = $service;
    }

    /*
     * Next level data function. Terrible comment.
     * getData("Yesterday at 3pm", "March 12th 2012", "/evanbtcohen/feed");
    */
    function getData($start, $end) {

        $query = '/me/home?limit=500';
        //fql?q=SELECT post_id, actor_id, target_id, message FROM stream WHERE filter_key in (SELECT filter_key FROM stream_filter WHERE uid = me() AND type = 'newsfeed')

        $results = json_decode($this->service->request($query))->data;
        $data = array();

        foreach($results as $result) {
            if (property_exists($result->from, "category"))
                continue;

            $data[] = $result;
        }

        return $data;
    }


    public function run($data) {

        $stories = 0;

        $types = array();
        $storyArray = array();


        foreach($data as $ele) {

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

            $stories++;
        }

        usort($storyArray, function ($a, $b) {
            return $a["likes"] < $b["likes"];
        });

        $newStories = array(
            "photos" => $this->getImportant("photo", $storyArray),
            "status" => $this->getImportant("status", $storyArray),
            "link" => $this->getImportant("link", $storyArray, 4)
        );

        return $newStories;
    }

    function formatData($data) {

        foreach(array($newStories["photos"], $newStories["status"], $newStories["link"])  as $type => $list) {
            echo "Type: ".$type."<br />";
            echo "<ul>";
            foreach($list as $story) {
                if (property_exists($story["original"], "picture")) {
                    echo '<img src="'.$story["original"]->picture.'" />';
                }
                echo "<li>".$story["likes"]." likes, type: ".$story["original"]->type."</li>";
            }
            echo "</ul>";
        }

        echo "<br />\n";

    }

    function getImportant($type, $stories, $limit = 0) {
        $popStories = array_filter($stories, function($item) use ($type, $limit){
            //die(var_dump($item["original"]->type));
            return $item["likes"] > 0 && $item["original"]->type == $type;
        });

        if (count($popStories) == 0) {
            return array();
        }

        if ($limit > 0) {
            $slice = array_slice($popStories, 0, $limit);
            if ($type == "photo") {
                $slice = $this->fixPictures($slice);
            }
            return $slice;
        }

        //die(var_dump(count($popStories)));

        $avg = array_reduce($popStories, function($acc, $item) {
            return $acc + $item["likes"];
        }) / count($popStories);


        $distFromAvg = array_map(function($item) use ($avg) {
            $dist = round(pow($item["likes"] - $avg,2));
            return $dist;
        }, $popStories);

        $stdDev = sqrt(array_sum($distFromAvg) / count($popStories));

        $results = array_filter($popStories, function($item) use ($avg, $stdDev){
            return $item["likes"] > $avg+$stdDev;
        });

        if ($type == "photo") {
            $results = $this->fixPictures($results);
        }

        return $results;
    }

    function fixPictures($array) {
        foreach($array as $photo) {

            try
            {
                $photoId = $photo["original"]->object_id;
                $photos = json_decode($this->service->request("/".$photoId))->images;

                $chosenPhoto = $photos[0];
                $photo["original"]->picture = $chosenPhoto->source;
            }
            catch(\Exception $e) {
                echo "failed<br />\n";
                continue;
            }
        }

        return $array;
    }
}