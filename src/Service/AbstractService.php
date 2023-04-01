<?php

namespace Hyperzod\GophrSdkPhp\Service;

/**
 * Abstract base class for all services.
 */
abstract class AbstractService
{
   /**
    * @var \Hyperzod\GophrSdkPhp\Client\GophrClientInterface
    */
   protected $client;

   /**
    * Initializes a new instance of the {@link AbstractService} class.
    *
    * @param \Hyperzod\GophrSdkPhp\Client\GophrClientInterface $client
    */
   public function __construct($client)
   {
      $this->client = $client;
   }

   /**
    * Gets the client used by this service to send requests.
    *
    * @return \Hyperzod\GophrSdkPhp\Client\GophrClientInterface
    */
   public function getClient()
   {
      return $this->client;
   }

   protected function request($method, $path, $params)
   {
      return $this->getClient()->request($method, $path, $params);
   }
}
