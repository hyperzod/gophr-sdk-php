<?php

namespace Hyperzod\GophrSdkPhp\Client;

use Exception;
use GuzzleHttp\Client;
use Hyperzod\GophrSdkPhp\Exception\InvalidArgumentException;

class BaseGophrClient implements GophrClientInterface
{

   /** @var array<string, mixed> */
   private $config;

   /**
    * Initializes a new instance of the {@link BaseGophrClient} class.
    *
    * The constructor takes two arguments.
    * @param string $api_key the API key of the client
    * @param string $api_base the base URL for Gophr's API
    */

   public function __construct($api_key, $api_base)
   {
      $config = $this->validateConfig(array(
         "api_key" => $api_key,
         "api_base" => $api_base
      ));

      $this->config = $config;
   }

   /**
    * Gets the API key used by the client to send requests.
    *
    * @return null|string the API key used by the client to send requests
    */
   public function getApiKey()
   {
      return $this->config['api_key'];
   }

   /**
    * Gets the base URL for Gophr's API.
    *
    * @return string the base URL for Gophr's API
    */
   public function getApiBase()
   {
      return $this->config['api_base'];
   }

   /**
    * Sends a request to Gophr's API.
    *
    * @param string $method the HTTP method
    * @param string $path the path of the request
    * @param array $params the parameters of the request
    */

   public function request($method, $path, $params)
   {
      $client = new Client([
         'headers' => [
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'API-KEY' => $this->getApiKey()
         ]
      ]);

      $api = $this->getApiBase() . $path;

      $response = $client->request($method, $api, [
         'http_errors' => true,
         'body' => json_encode($params)
      ]);

      return $this->validateResponse($response);
   }

   /**
    * @param array<string, mixed> $config
    *
    * @throws InvalidArgumentException
    */
   private function validateConfig($config)
   {
      // api_key
      if (!isset($config['api_key'])) {
         throw new InvalidArgumentException('api_key field is required');
      }

      if (!is_string($config['api_key'])) {
         throw new InvalidArgumentException('api_key must be a string');
      }

      if ('' === $config['api_key']) {
         throw new InvalidArgumentException('api_key cannot be an empty string');
      }

      if (preg_match('/\s/', $config['api_key'])) {
         throw new InvalidArgumentException('api_key cannot contain whitespace');
      }

      if (!isset($config['api_base'])) {
         throw new InvalidArgumentException('api_base field is required');
      }

      if (!is_string($config['api_base'])) {
         throw new InvalidArgumentException('api_base must be a string');
      }

      if ('' === $config['api_base']) {
         throw new InvalidArgumentException('api_base cannot be an empty string');
      }

      return [
         "api_key" => $config['api_key'],
         "api_base" => $config['api_base'],
      ];
   }

   private function validateResponse($response)
   {
      $status_code = $response->getStatusCode();

      if ($status_code >= 200 && $status_code < 300) {
         $response = json_decode($response->getBody(), true);
         if (isset($response["data"])) {
            return $response["data"];
         }
         throw new Exception("Data node not set in server response");
      } else {
         $response = json_decode($response->getBody(), true);
         if (isset($response["errors"])) {
            throw new Exception($response["errors"][0]["message"]);
         }
         throw new Exception("Errors node not set in server response");
      }
   }
}
