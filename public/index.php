<?php
declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use App\Format\JSON;
use App\Format\XML;
use App\Format\YAML;
use App\Format\FromStringInterface;
use App\Format\BaseFormat;
use App\Format\NamedFormatInterface;


$data = [
    "name" => "Henry",
    "surname" => "Webpro"
];

$formats = [
    new JSON($data),
    new XML($data),
    new YAML($data)
];

