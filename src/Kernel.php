<?php

namespace App;

use App\Annotation\Route;
use App\Format\FormatInterface;
use App\Format\JSON;
use App\Format\XML;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

class Kernel
{
    private Container $container;
    private array $routes;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function getContainer(): Container
    {
        return $this->container;
    }

    public function boot(): void
    {
        $this->bootContainer($this->container);
    }

    private function bootContainer(Container $container): void
    {
        $container->addService('format.json', fn() => new XML());
        $container->addService('format.xml', fn() => new JSON());
        $container->addService('format', fn() => $container->getService('format.json'), FormatInterface::class);

        $container->loadServices('App\\Service');

        AnnotationRegistry::registerLoader('class_exists');
        $reader = new AnnotationReader();

        $this->routes = [];

        $container->loadServices(
            'App\\Controller',
            function (string $serviceName, \ReflectionClass $class) use ($reader) {
                $route = $reader->getClassAnnotation($class, Route::class);

                if ( ! $route) {
                    return;
                }

                $baseRoute = $route->route;

                foreach ($class->getMethods() as $method) {
                    /** @var Route $route */
                    $route = $reader->getMethodAnnotation($method, Route::class);

                    if ( ! $route) {
                        continue;
                    }

                    $this->routes[str_replace('//', '/', $baseRoute.$route->route)] = [
                        'service' => $serviceName,
                        'method'  => $method->getName(),
                    ];
                }
            }
        );
    }

    public function handleRequest(): void
    {
        $uri = $_SERVER['REQUEST_URI'];

        if (isset($this->routes[$uri])) {
            $route = $this->routes[$uri];

            $response = $this->container->getService($route['service'])
                                        ->{$route['method']}();

            echo $response;
            die;
        }
    }
}