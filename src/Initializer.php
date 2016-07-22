<?php
/**
 * Will load the module, initiating dependencies, etc first
 * @author Martyn Bissett <martynbissett@yahoo.co.uk>
 */

namespace MartynBiz\Slim\Module;

use Slim\App;
use Slim\Container;

/**
 * This will load modules
 */
class Initializer
{
    /**
     * @var array
     */
    protected $moduleInstances = [];

    public function __construct($settings=array())
    {
        // build an class map of [[module => moduleClassPath], ..]
        foreach ($settings['modules'] as $moduleName => $moduleClassName) {
            $module = new $moduleClassName();
        	if (! $module instanceof ModuleInterface) throw new \Exception($moduleName . ' is not an instance of ModuleInterface');
        	$this->moduleInstances[$moduleName] = $module;
        }
    }

    /**
     * Load the module. This will run for all modules, use for routes mainly
     * @param string $moduleName Module name
     */
    public function initModules(App $app)
    {
        $container = $app->getContainer();

        $this->initDependencies($container);
        $this->initMiddleware($app);
        $this->initRoutes($app);
    }

    /**
     * Load the module. This will run for all modules, use for routes mainly
     * @param string $moduleName Module name
     */
    public function initDependencies(Container $container)
    {
        $moduleInstances = $this->moduleInstances;

        // next, init dependencies of all modules now that we have settings, class maps etc
        foreach ($moduleInstances as $module) {
            $module->initDependencies($container);
        }
    }

    /**
     * Load the module. This will run for all modules, use for routes mainly
     * @param string $moduleName Module name
     */
    public function initMiddleware(App $app)
    {
        $moduleInstances = $this->moduleInstances;

        // next, init app middleware of all modules now that we have settings, class maps, dependencies etc
        foreach ($moduleInstances as $module) {
            $module->initMiddleware($app);
        }
    }

    /**
     * Load the module. This will run for all modules, use for routes mainly
     * @param string $moduleName Module name
     */
    public function initRoutes(App $app)
    {
        $moduleInstances = $this->moduleInstances;

        // lastly, routes
        foreach ($moduleInstances as $module) {
            $module->initRoutes($app);
        }
    }
}
