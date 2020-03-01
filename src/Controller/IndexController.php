<?php

namespace App\Controller;

use App\Annotation\Route;
use App\Service\Serializer;

/**
 * @Route(route="/")
 */
class IndexController
{
    private Serializer $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route(route="/")
     */
    public function index(): string
    {
        return $this->serializer->serialize([
            'Action' => 'index',
            'Date' => date('Y-m-d'),
        ]);
    }
}
