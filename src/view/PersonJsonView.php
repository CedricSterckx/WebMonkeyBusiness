<?php

/**
 * Created by PhpStorm.
 * User: Cédric
 * Date: 08/04/2017
 * Time: 21:07
 */
class PersonJsonView
{

    public  function render(array $data) : array {
        $output = [];

        if(isset($data['person'])){
            $person  = $data['person'];
            $output = [
                'id' => $person->getId(),
                'name' => $person->getName()
            ];
        }

        return $output;
    }

}


