<?php
namespace Kr\OAuthClientBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Kr\OAuthClientBundle\DependencyInjection\KrOAuthClientBundleExtension;

class KrOAuthClientBundle extends Bundle
{
    public function __construct()
    {
        $this->extension = new KrOAuthClientBundleExtension();
    }
}