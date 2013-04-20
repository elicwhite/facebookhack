<?php
use OAuth\OAuth2\Service\Facebook;
use OAuth\Common\Storage\Memory;
use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Http\Uri\Uri;

require '../vendor/autoload.php';
require 'smart.php';

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
$facebookService = $serviceFactory->createService('facebook', $credentials, $storage, [] );


if (!$facebookService->getStorage()->hasAccessToken()) {
    if( !empty( $_GET['code'] ) ) {
        // This was a callback request from google, get the token
        $facebookService->requestAccessToken( $_GET['code'] );
        $url = $_SERVER['PHP_SELF'];
        header('Location: ' . $url);
        die();
    } elseif( !empty($_GET['go'] ) && $_GET['go'] == 'go' ) {
        $url = $facebookService->getAuthorizationUri();
        header('Location: ' . $url);
        die();
    } else {
        $url = $currentUri->getRelativeUri() . '?go=go';
        _add2page("<a class='btn' href='$url'>Login with Facebook!</a>");
    }
}
else
{
    // Send a request with it
    $result = json_decode( $facebookService->request( '/me' ), true );

    if(isset($_GET['logout'])){
        $facebookService->getStorage()->clearToken();
        _add2page('<p class="well">Logout successfull!!!!!!!!!</p>');
    }else{
    // Show some of the resultant data
    _add2page('<a href="?logout" class="btn pull-right">Logout</a>');
    _add2page('<p class="well">Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'] . '</p>');
    }
}

_generate("page.tpl");

if (isset($_GET["user"]) && $_GET["user"] == "Eli") {
    require_once("eli.php");
}