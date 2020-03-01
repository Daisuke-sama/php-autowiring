<?php

namespace App\Controller;

use App\Annotation\Route;
use App\Service\Serializer;


/**
 * @Route(route="/posts")
 */
class PostController
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
            'Action' => 'post',
            'Time'   => date('H:i:s'),
        ]);
    }

    /**
     * @Route(route="/page")
     */
    public function page(): string
    {
        return $this->serializer->serialize([
            'Action' => 'post',
            'Time'   => date('H:i:s'),
        ]);
    }
}
