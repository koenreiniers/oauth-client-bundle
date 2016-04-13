<?php
namespace Kr\OAuthClientBundle\Controller;

use Kr\OAuthClient\OAuthClient;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/oauth-client/authorize", name="oauth_client.authorize")
     */
    public function authorizeAction(Request $request)
    {
        /** @var OAuthClient $oauth */
        $oauth = $this->get("oauth.client");

        $oauth->startAuthorization();

        return new Response("Authorization failed");
    }

    /**
     * @Route("/oauth-client/redirect", name="oauth_client.redirect")
     */
    public function redirectAction(Request $request)
    {
        /** @var OAuthClient $oauth */
        $oauth = $this->get("oauth.client");

        $oauth->finishAuthorization();

        return new Response("Authorization succeeded");
    }
}
