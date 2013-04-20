<?php
    $val = $facebookService->request('/evanbtcohen/feed');
    $json = json_decode($val);

    die(var_dump($json->data));
?>
