<?php

namespace App\Controller;

use App\Service\Serializer;

class IndexController
{
    private Serializer $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function index(): string
    {
        return $this->serializer->serialize([
            'Action' => 'index',
            'Date' => date('Y-m-d H:i:s'),
        ]);
    }
}
