<?php
/**
 * Created by PhpStorm.
 * User: Cédric
 * Date: 14/04/2017
 * Time: 15:37
 */

namespace App\View;

interface Response
{
    public function draw(array $data);
}