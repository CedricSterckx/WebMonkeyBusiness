<?php
/**
 * Created by PhpStorm.
 * User: Cédric
 * Date: 14/04/2017
 * Time: 16:29
 */

namespace App\Model;

class EventFactory
{
    public static function create(array $data) {
        return new Event();
    }
}