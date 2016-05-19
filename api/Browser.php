<?php

namespace g9rga\newrelic\api;

use Yii;
use yii\web\View;
use WebApplication;

class Browser
{

    public function enableBrowserTimings()
    {
        Yii::$app->getView()->on(View::EVENT_AFTER_RENDER, function(){
            Yii::$app->view->registerJs(newrelic_get_browser_timing_header(false), View::POS_HEAD);
            Yii::$app->view->registerJs(newrelic_get_browser_timing_footer(false), View::EVENT_END_BODY);
        });
    }

    public function disableTimings()
    {
        return newrelic_disable_autorum();
    }

    /**
     * Enable capture request params, only for web application
     * @return boolean|null true on success
     */
    public function catchRequestParams()
    {
        if (Yii::$app instanceof WebApplication)
            return newrelic_capture_params(true);
    }
}