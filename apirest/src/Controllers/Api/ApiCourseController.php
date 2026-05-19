<?php

namespace App\Controllers\Api;

use App\Application\Course\CreateCourseCommand;
use App\Application\Course\CreateCourseHandler;
use App\Domain\Course\CourseId;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Infrastructure\Persistence\Doctrine\DoctrineCourseRepository;

class ApiCourseController
{
    private DoctrineCourseRepository $repository;
    private Response $response;

    public function __construct(private Request $request)
    {
        $entityManager = (require __DIR__ . '/../../../config/doctrine.php')();

        $this->repository = new DoctrineCourseRepository($entityManager);
        $this->response   = new Response();
    }

    private function courseToArray($c): array
    {
        return [
            'id'        => $c->id()->value(),
            'name'      => $c->name(),
            'available' => $c->isAvailable(),
        ];
    }

    public function index(): void
    {
        $courses = array_map([$this, 'courseToArray'], $this->repository->findAll());
        $this->response->json(['data' => $courses], 200)->send();
    }

    public function show(string $id): void
    {
        $course = $this->repository->find(new CourseId($id));

        if (!$course) {
            $this->response->json(['error' => 'Course not found'], 404)->send();
            return;
        }

        $this->response->json(['data' => $this->courseToArray($course)], 200)->send();
    }

    public function store(): void
    {
        $data = json_decode(file_get_contents('php://input'), true) ?? [];

        if (empty($data['name'])) {
            $this->response->json(['error' => 'Field "name" is required'], 422)->send();
            return;
        }

        $id      = $data['id'] ?? CourseId::generate()->value();
        $handler = new CreateCourseHandler($this->repository);
        $handler->handle(new CreateCourseCommand($id, $data['name']));

        $course = $this->repository->find(new CourseId($id));
        $this->response->json(['data' => $this->courseToArray($course)], 201)->send();
    }

    public function update(string $id): void
    {
        $course = $this->repository->find(new CourseId($id));

        if (!$course) {
            $this->response->json(['error' => 'Course not found'], 404)->send();
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true) ?? [];

        if (isset($data['name'])) {
            $course->rename($data['name']);
        }
        $this->repository->save($course);

        $updated = $this->repository->find(new CourseId($id));
        $this->response->json(['data' => $this->courseToArray($updated)], 200)->send();
    }

    public function destroy(string $id): void
    {
        $course = $this->repository->find(new CourseId($id));

        if (!$course) {
            $this->response->json(['error' => 'Course not found'], 404)->send();
            return;
        }

        $this->repository->delete(new CourseId($id));
        $this->response->json(['message' => 'Course deleted successfully'], 200)->send();
    }
}
