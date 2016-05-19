<?php

namespace g9rga\newrelic\api;


class Transaction
{

    /**
     * Add custom params to newrelic
     * @param $key
     * @param $value
     * @return boolean true on success
     */
    public function addParam($key, $value)
    {
        return newrelic_add_custom_parameter($key, $value);
    }

    /**
     * @param $name
     * @return boolean true on success
     */
    public function addTrace($name)
    {
        return newrelic_add_custom_tracer($name);
    }

    /**
     * Add custom metric
     * @param string $metricName
     * @param float $value
     * @return boolean true on success
     */
    public function addMetric($metricName, $value)
    {
        return newrelic_custom_metric($metricName, $value);
    }

    public function stopTransaction($dropData = false)
    {
        return newrelic_end_of_transaction($dropData);
    }

    public function ignoreApdex()
    {
        return newrelic_ignore_apdex();
    }

    public function ignoreTransaction()
    {
        return newrelic_ignore_transaction();
    }

    public function exception(\Exception $e)
    {
        return newrelic_notice_error($e->getMessage(), $e);
    }

    public function setName($name)
    {
        return newrelic_start_transaction ($name, $this->licenseKey);
    }
}