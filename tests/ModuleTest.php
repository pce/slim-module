<?php

use MartynBiz\Slim3Module\Initializer;

class ModuleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Slim\App Mock 
     */
    protected $appMock;

    public function setUp()
    {
        // Create a mock renderer to pass to our Renderer, any will do
        $this->appMock = $this->getMockBuilder('Slim\\App')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @test
     */
    public function initialization()
    {
        $initializer = new Initializer($this->appMock);

        $this->assertTrue($initializer instanceof Initializer);
    }

    /**
     * @test
     */
    public function initializationWithModule()
    {
        $initializer = new Initializer($this->appMock, ['Hello']);

        $this->assertTrue($initializer instanceof Initializer);
    }

    /**
     * @test
     */
    public function initializationOfModule()
    {
        $this->markTestSkipped(
            'TODO $app add container, settings.'
        );

        $initializer = new Initializer($app, ['Hello']);

        $initializer->initModules();

        $this->assertTrue($initializer instanceof Initializer);
    }
}
