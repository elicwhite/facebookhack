<?php
namespace Application\Modules\Main\Controllers;
/*
use OAuth\OAuth1\Signature\Signature;
use OAuth\Common\Storage\Session;
use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Http\Uri\Uri;
    */
class Login extends \Saros\Application\Controller
{
    private $fb;

    public function init() {
        $this->fb = $GLOBALS["registry"]->fb;

        if($this->fb->isAuthorized()) {
            // If they aren't signed in, redirect them
            //$this->redirect($GLOBALS["registry"]->utils->makeLink("Index"));
        }
    }


    public function indexAction()
    {
        $this->view->Uri = $GLOBALS["registry"]->utils->makeLink("Login", "login");
    }

    public function loginAction() {
        $this->fb->initSession();
    }

    public function callbackAction() {
        $this->fb->initSession();

        $this->redirect($GLOBALS["registry"]->utils->makeLink("Index", "info"));
    }

    /*
    public function callbackAction() {
        $token = $this->fb->requestAccessToken( $_GET['code'] );

        // Send a request with it
        $result = json_decode( $this->fb->request( '/me' ), true );

        // Show some of the resultant data
        echo 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];

    }
    */
}