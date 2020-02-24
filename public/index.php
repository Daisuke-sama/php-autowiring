<?php
declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use App\Format\JSON;
use App\Format\XML;
use App\Format\YAML;
use App\Format\FromStringInterface;
use App\Format\BaseFormat;
use App\Format\NamedFormatInterface;
use App\Serializer;


$data = [
    "name" => "Henry",
    "surname" => "Webpro"
];

$serializer = new Serializer(new YAML());
var_dump($serializer->serialize($data));

//$formats = [
//    new JSON($data),
//    new XML($data),
//    new YAML($data)
//];

