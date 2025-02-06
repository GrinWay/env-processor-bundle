Installation
------

1. Execute (for `vendor` dependencies)

```console
composer require grinway/env-processor-bundle
```

[//]: # (> NOTE: With the help of the composer recipe you will get<br>`config/packages/grinway_service.yaml`)
[//]: # (> <br>**Check it's not empty!**)

[//]: # (If you didn't get these configuration files just copy them from `@GrinWayService/.install/symfony/config`)

2. Add this to your `bundles.php`

```php
<?php

// %kernel.project_dir%/config/bundles.php
return [
    GrinWay\Service\GrinWayEnvProcessorBundle::class => ['all' => true],
];
```
