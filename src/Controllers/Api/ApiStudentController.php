<?php

namespace App\Controllers\Api;

use App\Application\Student\CreateStudentCommand;
use App\Application\Student\CreateStudentHandler;
use App\Domain\Student\StudentId;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Infrastructure\Persistence\Doctrine\DoctrineStudentRepository;

class ApiStudentController
{
    private DoctrineStudentRepository $repository;
    private Response $response;

    public function __construct(private Request $request)
    {
        $entityManager = require __DIR__ . '/../../../../bootstrap.php';

        $this->repository = new DoctrineStudentRepository($entityManager);
        $this->response   = new Response();
    }

    public function index(): void
    {
        $students = array_map(
            fn($s) => ['id' => $s->id()->value(), 'name' => $s->name(), 'email' => $s->email()],
            $this->repository->findAll()
        );

        $this->response->json(['data' => $students], 200)->send();
    }

    public function show(string $id): void
    {
        $student = $this->repository->find(new StudentId($id));

        if (!$student) {
            $this->response->json(['error' => 'Student not found'], 404)->send();
            return;
        }

        $this->response->json([
            'data' => [
                'id'    => $student->id()->value(),
                'name'  => $student->name(),
                'email' => $student->email(),
            ]
        ], 200)->send();
    }

    public function store(): void
    {
        $data = json_decode(file_get_contents('php://input'), true) ?? [];

        if (empty($data['name']) || empty($data['email'])) {
            $this->response->json(['error' => 'Fields "name" and "email" are required'], 422)->send();
            return;
        }

        $id      = $data['id'] ?? StudentId::generate()->value();
        $handler = new CreateStudentHandler($this->repository);
        $handler->handle(new CreateStudentCommand($id, $data['name'], $data['email']));

        $student = $this->repository->find(new StudentId($id));
        $this->response->json([
            'data' => [
                'id'    => $student->id()->value(),
                'name'  => $student->name(),
                'email' => $student->email(),
            ]
        ], 201)->send();
    }

    public function update(string $id): void
    {
        $student = $this->repository->find(new StudentId($id));

        if (!$student) {
            $this->response->json(['error' => 'Student not found'], 404)->send();
            return;
        }

        $data  = json_decode(file_get_contents('php://input'), true) ?? [];
        $name  = $data['name']  ?? $student->name();
        $email = $data['email'] ?? $student->email();

        $handler = new CreateStudentHandler($this->repository);
        $handler->handle(new CreateStudentCommand($id, $name, $email));

        $updated = $this->repository->find(new StudentId($id));
        $this->response->json([
            'data' => [
                'id'    => $updated->id()->value(),
                'name'  => $updated->name(),
                'email' => $updated->email(),
            ]
        ], 200)->send();
    }

    public function destroy(string $id): void
    {
        $student = $this->repository->find(new StudentId($id));

        if (!$student) {
            $this->response->json(['error' => 'Student not found'], 404)->send();
            return;
        }

        $this->repository->delete(new StudentId($id));
        $this->response->json(['message' => 'Student deleted successfully'], 200)->send();
    }
}
