<?php

/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 7/04/16
 * Time: 19:00
 */

namespace AppBundle\Handler;


interface HandlerInterface
{
    public function all();

    public function get($id);

    public function delete($id);

    public function post(array $parameters);

    public function put($id, array $parameters);

    public function process($document, array $parameters, $method = null);

    public function createEntityClass();

}