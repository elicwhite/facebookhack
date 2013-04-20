<?php
use OAuth\OAuth2\Service\Facebook;
use OAuth\Common\Storage\Memory;
use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Http\Uri\Uri;

require 'vendor/autoload.php';

// In-memory storage
$storage = new Memory();

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

if( !empty( $_GET['code'] ) ) {
    // This was a callback request from google, get the token
    $token = $facebookService->requestAccessToken( $_GET['code'] );

    // Send a request with it
    $result = json_decode( $facebookService->request( '/me' ), true );

    // Show some of the resultant data
    echo 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];

} elseif( !empty($_GET['go'] ) && $_GET['go'] == 'go' ) {
    $url = $facebookService->getAuthorizationUri();
    header('Location: ' . $url);
} else {
    $url = $currentUri->getRelativeUri() . '?go=go';
    echo "<a href='$url'>Login with Facebook!</a>";
}