<?php
/**
 * Created by PhpStorm.
 * User: Cédric
 * Date: 14/04/2017
 * Time: 15:36
 */

namespace App\View;

use App\View\Response;

abstract class JsonResponse Implements Response
{
   public function draw(array $data)
   {
       header('Content-Type: application/json');
       $result = json_encode($this->render($data));
       echo $result;
       return $result;
   }

   protected abstract function render(array $data);
}