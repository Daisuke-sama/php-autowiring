<?php

declare(strict_types=1);

use App\Kernel;

require __DIR__.'/../vendor/autoload.php';


$kernel = new Kernel();
$kernel->boot();
$kernel->handleRequest();
//$container = $kernel->getContainer();


