# yii2-newrelic
Simple newrelic integration with yii2.

Usage:
```php
'bootstrap' => ['newrelic'],
'components' => [
  'newrelic' => [
      'class' => 'g9rga\newrelic\Newrelic',
      'licenseKey' => 'LICENSE_KEY_HERE',
      'enabled' => true,
      'applicationName' => 'web',
      'enableBrowserTimings' => true
  ]
]
```
