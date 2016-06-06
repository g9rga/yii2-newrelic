<?php

namespace g9rga\newrelic\api;


class Application
{

    public function markAsBackground()
    {
        return newrelic_background_job(true);
    }

    public function setName($name, $licenseKey)
    {
        return newrelic_set_appname($name, $licenseKey);
    }

}