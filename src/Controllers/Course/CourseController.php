<?php

namespace App\Controllers\Course;

use App\Application\Course\CreateCourseCommand;
use App\Application\Course\CreateCourseHandler;
use App\Domain\Course\CourseId;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Infrastructure\Persistence\Json\JsonCourseRepository;

class CourseController
{
    private JsonCourseRepository $repository;

    public function __construct(private Request $request)
    {
        $this->repository = new JsonCourseRepository();
    }

    public function create(): void
    {
        $courses = $this->repository->findAll();
        $response = (new Response())->html('courses/create', ['courses' => $courses]);
        $response->send();
    }

    public function store(): void
    {
        $data = $_POST;

        $handler = new CreateCourseHandler($this->repository);
        $handler->handle(new CreateCourseCommand(
            $data['id'] ?? CourseId::generate()->value(),
            $data['name']
        ));

        header('Location: /course/create');
        exit;
    }
}
