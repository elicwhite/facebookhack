<?php
namespace Application\Classes;

class FB
{
    protected $service;

    protected $oauthToken;
    protected $oauthSecret;

    protected $userId = '-';
    protected $responseFormat;

    /**
     * @param string $consumer_key Application consumer key for Fitbit API
     * @param string $consumer_secret Application secret
     * @param int $debug Debug mode (0/1) enables OAuth internal debug
     * @param string $user_agent User-agent to use in API calls
     * @param string $response_format Response format (json or xml) to use in API calls
     */
    public function __construct($consumer_key, $consumer_secret, $callbackUrl = null, \OAuth\Common\Storage\TokenStorageInterface $storageAdapter = null)
    {
        // If callback url wasn't set, use the current url
        if ($callbackUrl == null) {
            $uriFactory = new \OAuth\Common\Http\Uri\UriFactory();
            $currentUri = $uriFactory->createFromSuperGlobalArray($_SERVER);
            $currentUri->setQuery('');
            $callbackUrl = $currentUri->getAbsoluteUri();
        }

        $factory = new \OAuth\ServiceFactory();

        $credentials = new \OAuth\Common\Consumer\Credentials(
            $consumer_key,
            $consumer_secret,
            $callbackUrl
        );

        if ($storageAdapter == null)
        {
            $storageAdapter = new \OAuth\Common\Storage\Session();
        }

        $this->service = $factory->createService('facebook', $credentials, $storageAdapter);
    }

    public function isAuthorized() {
        return $this->service->getStorage()->hasAccessToken();
    }

    /**
    * Authorize the user
    *
    */
    public function initSession() {

        if (empty($_SESSION['fb_Session']))
            $_SESSION['fb_Session'] = 0;


        if (!isset($_GET['code']) && $_SESSION['fb_Session'] == 1)
            $_SESSION['fb_Session'] = 0;


        if ($_SESSION['fb_Session'] == 0) {
            $url = $this->service->getAuthorizationUri();

            $_SESSION['fb_Session'] = 1;
            header('Location: ' . $url);
            exit;

        } else if ($_SESSION['fb_Session'] == 1) {
            $token = $this->service->requestAccessToken($_GET['code']);
            // This was a callback request from fitbit, get the token

            $_SESSION['fb_Session'] = 2;

            return 1;

        }
    }

    /**
     * Reset session
     *
     * @return void
     */
    public function resetSession()
    {
        // TODO: Need to add clear to the interface for phpoauthlib
        $this->service->getStorage()->clearToken();
        unset($_SESSION["fb_Session"]);
    }

    public function getService() {
        return $this->service;
    }
}