<?php

namespace Hyperzod\GophrSdkPhp\Service;

use Hyperzod\GophrSdkPhp\Enums\HttpMethodEnum;

class TaskService extends AbstractService
{
   /**
    * Create a task on gophr
    *
    * @param array $params
    *
    * @throws \Hyperzod\GophrSdkPhp\Exception\ApiErrorException if the request fails
    *
    */
   public function create(array $params)
   {
      return $this->request(HttpMethodEnum::POST, '/jobs', $params);
   }
}
