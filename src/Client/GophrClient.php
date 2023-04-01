<?php

namespace Hyperzod\GophrSdkPhp\Client;

use Hyperzod\GophrSdkPhp\Service\CoreServiceFactory;

class GophrClient extends BaseGophrClient
{
    /**
     * @var CoreServiceFactory
     */
    private $coreServiceFactory;

    public function __get($name)
    {
        if (null === $this->coreServiceFactory) {
            $this->coreServiceFactory = new CoreServiceFactory($this);
        }

        return $this->coreServiceFactory->__get($name);
    }
}
