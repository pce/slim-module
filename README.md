# Slim v3 module #


## Introduction ##

Modules for Slim3

Fork of https://github.com/martynbiz/slim-module with the following changes:

- Path of Modules (Initializer) autoload within namespace: Modules\%s\Module.php
- README Update

## Installation ##

Composer

```php
"require-dev": {
    "pce/slim3-module": "dev-master"
}
```

## Simple Usage ##

This library expects a modules directory somewhere, and within that module directories:

```
modules/
├── Modules (namespace)
│   └── ACMEReport
 \      ├── templates/report.twig 
  |     ├── ActionHandler.php 
  /     └── Module.php
 ^       
```


add path of modules to the loader `public/index.php`:

```
$loader = require __DIR__ . '/../vendor/autoload.php';
$loader->add('Modules\\', __DIR__ . '/../app/modules/');
```



setup "autoloader" of routes in `app/routes.php`:

```
$moduleInitializer = new \MartynBiz\Slim3Module\Initializer($app, [
    'Hello',
    'ACMEReport'
]);
$moduleInitializer->initModules();
```

Or modules file, which returns an array of Modulenames:
```
$moduleInitializer = new \MartynBiz\Slim3Module\Initializer($app, 
  require __DIR__ . '/modules.php';
);
$moduleInitializer->initModules();
```






## Module Example##

- register route for a the Module Controller,
- add the "twig-view" templates directory in the modules own directory, usage
  `@acme_report/index.twig`

```
<?php

namespace Modules\ACMEReport;

use MartynBiz\Slim3Module\AbstractModule;

use Slim\App;
use Slim\Container;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


class Module extends AbstractModule {

    public function initRoutes(App $app) 
    {
	$app->get('/acme/report', 'Modules\ACMEReport\ActionHandler:dispatchGet');
    }

    public function initDependencies(Container $container)
    {
       $container['Modules\ACMEReport\ActionHandlerModules'] = function ($container) {
    		return new \Modules\ACMEReport\ActionHandler($container);
	};

       $container['view']->getLoader()->addPath(__DIR__ . '/templates', 'acme_report');

    }

}

```

