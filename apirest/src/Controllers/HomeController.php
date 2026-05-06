<?php

namespace App\Controllers;

use App\Infrastructure\Http\Response;

class HomeController
{
    public function __construct(private mixed $request = null) {}

    public function index(): void
    {
        $response = (new Response())->html('home');
        $response->send();
    }

    public function student(): void
    {
        $response = (new Response())->html('students/index');
        $response->send();
    }

    public function teacher(): void
    {
        $response = (new Response())->html('teachers/index');
        $response->send();
    }

    public function subject(): void
    {
        $response = (new Response())->html('subjects/index');
        $response->send();
    }

    public function course(): void
    {
        $response = (new Response())->html('courses/index');
        $response->send();
    }

    public function enrollment(): void
    {
        $response = (new Response())->html('enrollment/index');
        $response->send();
    }
}
