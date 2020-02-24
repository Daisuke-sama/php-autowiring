<?php

declare(strict_types=1);


require __DIR__.'/../vendor/autoload.php';

use App\Container;
use App\Controller\IndexController;
use App\Format\FormatInterface;
use App\Format\JSON;
use App\Format\XML;
use App\Service\Serializer;


$data = [
    "name"    => "Henry",
    "surname" => "Webpro"
];

$serializer = new Serializer(new JSON());
$controller = new IndexController($serializer);

$container = new Container();
$container->addService('format.json', fn() => new XML());
$container->addService('format.xml', fn() => new JSON());
$container->addService('format', fn() => $container->getService('format.json'), FormatInterface::class);
//$container->addService('serializer', fn() => new Serializer($container->getService('format')));
//$container->addService('controller.index', fn() => new IndexController($container->getService('serializer')));

$container->loadServices('App\\Service');
$container->loadServices('App\\Controller');

var_dump($container->getService('App\\Controller\\IndexController')->index());
var_dump($container->getService('App\\Controller\\PostController')->index());
var_dump($container->getServices());
