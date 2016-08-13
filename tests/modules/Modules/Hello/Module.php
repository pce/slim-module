<?php

namespace Modules\Hello;

use MartynBiz\Slim3Module\AbstractModule;
use Slim\App;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class Module extends AbstractModule
{
    public function initRoutes(App $app)
    {
        $app->get('/hello/{name}', function (Request $request, Response $response) {
            $name = $request->getAttribute('name');
            $response->getBody()->write("Hello, $name");

            return $response;
        });
    }
}
