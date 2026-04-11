<?php

namespace App\Controllers\Api;

use App\Application\Teacher\CreateTeacherCommand;
use App\Application\Teacher\CreateTeacherHandler;
use App\Domain\Teacher\TeacherId;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Infrastructure\Persistence\Json\JsonTeacherRepository;

class ApiTeacherController
{
    private JsonTeacherRepository $repository;
    private Response $response;

    public function __construct(private Request $request)
    {
        $this->repository = new JsonTeacherRepository();
        $this->response   = new Response();
    }

    /** GET /api/teachers */
    public function index(): void
    {
        $teachers = array_map(
            fn($t) => ['id' => $t->id()->value(), 'name' => $t->name(), 'email' => $t->email()],
            $this->repository->findAll()
        );

        $this->response->json(['data' => $teachers], 200)->send();
    }

    /** GET /api/teachers/{id} */
    public function show(string $id): void
    {
        $teacher = $this->repository->find(new TeacherId($id));

        if (!$teacher) {
            $this->response->json(['error' => 'Teacher not found'], 404)->send();
            return;
        }

        $this->response->json([
            'data' => [
                'id'    => $teacher->id()->value(),
                'name'  => $teacher->name(),
                'email' => $teacher->email(),
            ]
        ], 200)->send();
    }

    /** POST /api/teachers */
    public function store(): void
    {
        $data = json_decode(file_get_contents('php://input'), true) ?? [];

        if (empty($data['name']) || empty($data['email'])) {
            $this->response->json(['error' => 'Fields "name" and "email" are required'], 422)->send();
            return;
        }

        $id      = $data['id'] ?? TeacherId::generate()->value();
        $handler = new CreateTeacherHandler($this->repository);
        $handler->handle(new CreateTeacherCommand($id, $data['name'], $data['email']));

        $teacher = $this->repository->find(new TeacherId($id));
        $this->response->json([
            'data' => [
                'id'    => $teacher->id()->value(),
                'name'  => $teacher->name(),
                'email' => $teacher->email(),
            ]
        ], 201)->send();
    }

    /** PUT /api/teachers/{id} */
    public function update(string $id): void
    {
        $teacher = $this->repository->find(new TeacherId($id));

        if (!$teacher) {
            $this->response->json(['error' => 'Teacher not found'], 404)->send();
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true) ?? [];
        $name  = $data['name']  ?? $teacher->name();
        $email = $data['email'] ?? $teacher->email();

        // Re-create with updated values (immutable domain entity)
        $handler = new CreateTeacherHandler($this->repository);
        $handler->handle(new CreateTeacherCommand($id, $name, $email));

        $updated = $this->repository->find(new TeacherId($id));
        $this->response->json([
            'data' => [
                'id'    => $updated->id()->value(),
                'name'  => $updated->name(),
                'email' => $updated->email(),
            ]
        ], 200)->send();
    }

    /** DELETE /api/teachers/{id} */
    public function destroy(string $id): void
    {
        $teacher = $this->repository->find(new TeacherId($id));

        if (!$teacher) {
            $this->response->json(['error' => 'Teacher not found'], 404)->send();
            return;
        }

        $this->repository->delete(new TeacherId($id));
        $this->response->json(['message' => 'Teacher deleted successfully'], 200)->send();
    }
}
