<?php

namespace App\Controllers\Api;

use App\Application\Subject\AssignTeacherToSubjectCommand;
use App\Application\Subject\AssignTeacherToSubjectHandler;
use App\Application\Subject\CreateSubjectCommand;
use App\Application\Subject\CreateSubjectHandler;
use App\Domain\Subject\SubjectId;
use App\Domain\Teacher\TeacherId;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Infrastructure\Persistence\Json\JsonSubjectRepository;
use App\Infrastructure\Persistence\Json\JsonTeacherRepository;

class ApiSubjectController
{
    private JsonSubjectRepository $repository;
    private Response $response;

    public function __construct(private Request $request)
    {
        $this->repository = new JsonSubjectRepository();
        $this->response   = new Response();
    }

    private function subjectToArray($s): array
    {
        return [
            'id'                 => $s->id()->value(),
            'name'               => $s->name(),
            'teacherId'          => $s->teacherId()?->value(),
            'enrolledStudentIds' => $s->enrolledStudentIds(),
        ];
    }

    /** GET /api/subjects */
    public function index(): void
    {
        $subjects = array_map([$this, 'subjectToArray'], $this->repository->findAll());
        $this->response->json(['data' => $subjects], 200)->send();
    }

    /** GET /api/subjects/{id} */
    public function show(string $id): void
    {
        $subject = $this->repository->find(new SubjectId($id));

        if (!$subject) {
            $this->response->json(['error' => 'Subject not found'], 404)->send();
            return;
        }

        $this->response->json(['data' => $this->subjectToArray($subject)], 200)->send();
    }

    /** POST /api/subjects */
    public function store(): void
    {
        $data = json_decode(file_get_contents('php://input'), true) ?? [];

        if (empty($data['name'])) {
            $this->response->json(['error' => 'Field "name" is required'], 422)->send();
            return;
        }

        $id      = $data['id'] ?? SubjectId::generate()->value();
        $handler = new CreateSubjectHandler($this->repository);
        $handler->handle(new CreateSubjectCommand($id, $data['name']));

        $subject = $this->repository->find(new SubjectId($id));
        $this->response->json(['data' => $this->subjectToArray($subject)], 201)->send();
    }

    /** PUT /api/subjects/{id} */
    public function update(string $id): void
    {
        $subject = $this->repository->find(new SubjectId($id));

        if (!$subject) {
            $this->response->json(['error' => 'Subject not found'], 404)->send();
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true) ?? [];
        $name = $data['name'] ?? $subject->name();

        $handler = new CreateSubjectHandler($this->repository);
        $handler->handle(new CreateSubjectCommand($id, $name));

        $updated = $this->repository->find(new SubjectId($id));
        $this->response->json(['data' => $this->subjectToArray($updated)], 200)->send();
    }

    /** DELETE /api/subjects/{id} */
    public function destroy(string $id): void
    {
        $subject = $this->repository->find(new SubjectId($id));

        if (!$subject) {
            $this->response->json(['error' => 'Subject not found'], 404)->send();
            return;
        }

        $this->repository->delete(new SubjectId($id));
        $this->response->json(['message' => 'Subject deleted successfully'], 200)->send();
    }

    /** POST /api/subjects/{id}/assign-teacher */
    public function assignTeacher(string $id): void
    {
        $subject = $this->repository->find(new SubjectId($id));

        if (!$subject) {
            $this->response->json(['error' => 'Subject not found'], 404)->send();
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true) ?? [];

        if (empty($data['teacherId'])) {
            $this->response->json(['error' => 'Field "teacherId" is required'], 422)->send();
            return;
        }

        // Validate the teacher exists
        $teacherRepo = new JsonTeacherRepository();
        $teacher = $teacherRepo->find(new TeacherId($data['teacherId']));
        if (!$teacher) {
            $this->response->json(['error' => 'Teacher not found'], 404)->send();
            return;
        }

        $handler = new AssignTeacherToSubjectHandler($teacherRepo, $this->repository);
        $handler->handle(new AssignTeacherToSubjectCommand($data['teacherId'], $id));

        $updated = $this->repository->find(new SubjectId($id));
        $this->response->json(['data' => $this->subjectToArray($updated)], 200)->send();
    }
}
