<?php

namespace Hyperzod\GophrSdkPhp\Client;

/**
 * Interface for a Gophr client.
 */
interface BaseGophrClientInterface
{
   /**
    * Gets the API key used by the client to send requests.
    *
    * @return null|string the API key used by the client to send requests
    */
   public function getApiKey();

   /**
    * Gets the base URL for Gophr's API.
    *
    * @return string the base URL for Gophr's API
    */
   public function getApiBase();
}
