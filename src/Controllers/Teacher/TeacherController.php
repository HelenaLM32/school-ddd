<?php

namespace App\Controllers\Teacher;

use App\Application\Teacher\CreateTeacherCommand;
use App\Application\Teacher\CreateTeacherHandler;
use App\Domain\Teacher\TeacherId;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Infrastructure\Persistence\Json\JsonTeacherRepository;

class TeacherController
{
    private JsonTeacherRepository $repository;

    public function __construct(private Request $request)
    {
        $this->repository = new JsonTeacherRepository();
    }

    public function create(): void
    {
        $teachers = $this->repository->findAll();
        $response = (new Response())->html('teachers/create', ['teachers' => $teachers]);
        $response->send();
    }

    public function store(): void
    {
        $data = $_POST;

        $handler = new CreateTeacherHandler($this->repository);
        $handler->handle(new CreateTeacherCommand(
            $data['id'] ?? TeacherId::generate()->value(),
            $data['name'],
            $data['email']
        ));

        header('Location: /teacher/create');
        exit;
    }
}
