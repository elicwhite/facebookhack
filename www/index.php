<?php
use OAuth\OAuth2\Service\Facebook;
use OAuth\Common\Storage\Memory;
use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Http\Uri\Uri;

require '../vendor/autoload.php';

// In-memory storage
$storage = new \OAuth\Common\Storage\Session();

$uriFactory = new \OAuth\Common\Http\Uri\UriFactory();
$currentUri = $uriFactory->createFromSuperGlobalArray($_SERVER);
$currentUri->setQuery('');

// Setup the credentials for the requests
$credentials = new Credentials(
    $_SERVER["CLIENT"],
    $_SERVER["SECRET"],
    $currentUri->getAbsoluteUri()
);

$serviceFactory = new \OAuth\ServiceFactory();

// Instantiate the facebook service using the credentials, http client and storage mechanism for the token
/** @var $facebookService Facebook */
$facebookService = $serviceFactory->createService('facebook', $credentials, $storage, ["read_stream", "user_activities", "user_checkins", "user_photos", "user_status", "user_videos"] );

$PAGE_VARS = array();

#smart as fuck <-- best comment ever <-- seccond best comment ever...
require 'smart.php';
require_once("history.php");


if (!$facebookService->getStorage()->hasAccessToken()) {
    if( !empty( $_GET['code'] ) ) {
        // This was a callback request from google, get the token
        $facebookService->requestAccessToken( $_GET['code'] );
        redirect2self();
        die();
    } elseif( !empty($_GET['go'] ) && $_GET['go'] == 'go' ) {
        $url = $facebookService->getAuthorizationUri();
        header('Location: ' . $url);
        die();
    } else {
        $url = $currentUri->getRelativeUri() . '?go=go';
        $PAGE_VARS['user_button'] = "<a class='btn' href='$url'>Login with Facebook!</a>";
    }
}
else{
    // Send a request with it
    $fbUser = json_decode( $facebookService->request( '/me' ), true );
    if(isset($_GET['debug'])){
        print '<pre>';
        print_r($fbUser);
        $val = $facebookService->request('/'.$fbUser['username'].'/feed');
        $json = json_decode($val);
        print_r($json);
        print '</pre>';
    }

    if(isset($_GET['logout'])){
        $facebookService->getStorage()->clearToken();
        redirect2self();
        die();
    }else{
    // Show some of the result data
    $PAGE_VARS['user_button'] = '<a href="?logout" class="btn pull-right">Logout</a>';
    echo('<p class="well">Your unique facebook user id is: ' . $fbUser['id'] . ' and your name is ' . $fbUser['name'] . '</p>');
    }
}



_generate("head.tpl");

if(isset($_GET['friend'])){
    $fbHistory = new History($facebookService, $_GET['friend']);
    $PAGE_VARS['types'] = $fbHistory->run();
    _generate("page.tpl");
}

_generate("footer.tpl");
