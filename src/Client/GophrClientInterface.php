<?php

namespace Hyperzod\GophrSdkPhp\Client;

/**
 * Interface for a Gophr client.
 */
interface GophrClientInterface extends BaseGophrClientInterface
{
   /**
    * Sends a request to Gophr's API.
    *
    * @param string $method the HTTP method
    * @param string $path the path of the request
    * @param array $params the parameters of the request
    */
   public function request($method, $path, $params);
}
