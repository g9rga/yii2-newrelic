<?php
namespace g9rga\newrelic;

use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use Yii;
use yii\web\Application as WebApplication;
use yii\console\Application as ConsoleApplication;
use yii\base\Component;

/**
 * Class Newrelic
 * @package g9rga\newrelic
 * @property api\Application $application
 * @property api\Browser $browser
 * @property api\Transaction $transaction
 * @property api\User $user
 */
class Newrelic extends Component implements BootstrapInterface
{
    public $licenseKey;
    public $enabled;
    public $applicationName;
    public $enableBrowserTimings;

    private $apiComponents = [];

    public function bootstrap($app)
    {
        if (!$this->enabled)
            return null;
        if (!$this->licenseKey)
            throw new InvalidConfigException('License key should be set');

        $this->application->setName($this->applicationName, $this->licenseKey);

        if (Yii::$app instanceof ConsoleApplication) {
            $this->application->markAsBackground();
        }

        if (Yii::$app instanceof WebApplication) {
            if ($this->enableBrowserTimings) {
                $this->browser->enableBrowserTimings();
            } else {
                $this->browser->disableTimings();
            }
        }
    }

    /**
     * @return Application
     */
    public function getApplication()
    {
        return $this->get('application');
    }

    /**
     * @throws InvalidConfigException
     * @return Browser
     */
    public function getBrowser()
    {
        if (!Yii::$app instanceof WebApplication) {
            throw new InvalidConfigException('Web application required');
        }
        return $this->get('browser');
    }

    /**
     * @throws InvalidConfigException
     * @return User
     */
    public function getUser()
    {
        if (!Yii::$app instanceof WebApplication) {
            throw new InvalidConfigException('Web application required');
        }
        return $this->get('user');
    }

    /**
     * @return Transaction
     */
    public function getTransaction()
    {
        return $this->get('transaction');
    }

    private function get($apiClass)
    {
        if (!isset($this->apiComponents[$apiClass])) {
            $fullDefinition = __NAMESPACE__ . '\\api\\' . ucfirst($apiClass);
            $this->apiComponents[$apiClass] = new $fullDefinition;
        }
        return $this->apiComponents[$apiClass];
    }
}