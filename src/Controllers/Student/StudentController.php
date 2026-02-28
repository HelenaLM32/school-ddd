<?php

namespace App\Controllers\Student;

use App\Application\Student\CreateStudentCommand;
use App\Application\Student\CreateStudentHandler;
use App\Domain\Student\StudentId;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Infrastructure\Persistence\Json\JsonStudentRepository;

class StudentController
{
    private JsonStudentRepository $repository;

    public function __construct(private Request $request)
    {
        $this->repository = new JsonStudentRepository();
    }

    public function create(): void
    {
        $students = $this->repository->findAll();
        $response = (new Response())->html('students/create', ['students' => $students]);
        $response->send();
    }

    public function store(): void
    {
        $data = $_POST;

        $handler = new CreateStudentHandler($this->repository);
        $handler->handle(new CreateStudentCommand(
            $data['id'] ?? StudentId::generate()->value(),
            $data['name'],
            $data['email']
        ));

        header('Location: /student/create');
        exit;
    }
}
