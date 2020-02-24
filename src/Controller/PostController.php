<?php

namespace App\Controller;

use App\Service\Serializer;

class PostController
{
    private Serializer $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function index(): string
    {
        return $this->serializer->serialize([
            'Action' => 'post',
            'Time' => date('H:i:s'),
        ]);
    }
}
