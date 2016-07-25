<?php
/**
 * The interface that Modules should implement
 * @author Martyn Bissett <martynbissett@yahoo.co.uk>
 */

namespace MartynBiz\Slim\Module;

use Slim\App;
use Slim\Container;

interface ModuleInterface
{
    /**
     * Initiate app dependencies
     * @param Container $container
     * @return void
     */
    public function initDependencies(Container $container);

    /**
     * Initiate app middleware (route middleware should go in initRoutes)
     * @param App $app
     * @return void
     */
    public function initMiddleware(App $app);

    /**
     * Load is run last, when config, dependencies, etc have been initiated
     * Routes ought to go here
     * @param App $app
     * @return void
     */
    public function initRoutes(App $app);

    // /**
    //  * Will copy files from vendor package to project
    //  * @param App $app
    //  * @return void
    //  */
    // public function copyFiles($dest);
}
