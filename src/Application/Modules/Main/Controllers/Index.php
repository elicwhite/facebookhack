<?php
namespace Application\Modules\Main\Controllers;

class Index extends \Saros\Application\Controller
{
    private $storage;

    public function init() {
        $this->storage = new \Saros\Session("storage");

        if(!$GLOBALS["registry"]->fb->isAuthorized()) {
            // If they aren't signed in, redirect them
            $this->redirect($GLOBALS["registry"]->utils->makeLink("Login", "index"));
        }

        if (!isset($this->storage["personal"]))
        {
            $service = $GLOBALS["registry"]->fb->getService();

            // Send a request with it
            $result = json_decode( $service->request( '/me' ), true );

            // Show some of the resultant data
            echo 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];

            $this->storage["personal"] = $result;
        }
    }

	public function indexAction()
	{
        echo "Hi ".$this->storage["personal"]["name"];
		$this->view->Version = \Saros\Version::getVersion();
	}


    public function logoutAction() {
        $GLOBALS["registry"]->fb->resetSession();
        $this->storage->clear();
        $this->redirect($GLOBALS["registry"]->utils->makeLink("Index"));
    }
}
