<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 8/26/16
 * Time: 7:10 PM
 */

namespace g9rga\newrelic\api;


class NullApi
{

    public function __call($name, $arguments)
    {
        return null;
    }
}