<?php

namespace App\Controllers\Subject;

use App\Application\Subject\CreateSubjectCommand;
use App\Application\Subject\CreateSubjectHandler;
use App\Application\Subject\AssignTeacherToSubjectCommand;
use App\Application\Subject\AssignTeacherToSubjectHandler;
use App\Domain\Subject\SubjectId;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Infrastructure\Persistence\Json\JsonSubjectRepository;
use App\Infrastructure\Persistence\Json\JsonTeacherRepository;

class SubjectController
{
    private JsonSubjectRepository $subjectRepo;
    private JsonTeacherRepository $teacherRepo;

    public function __construct(private Request $request)
    {
        $this->subjectRepo = new JsonSubjectRepository();
        $this->teacherRepo = new JsonTeacherRepository();
    }

    public function create(): void
    {
        $subjects = $this->subjectRepo->findAll();
        $response = (new Response())->html('subjects/create', ['subjects' => $subjects]);
        $response->send();
    }

    public function store(): void
    {
        $data = $_POST;

        $handler = new CreateSubjectHandler($this->subjectRepo);
        $handler->handle(new CreateSubjectCommand(
            $data['id'] ?? SubjectId::generate()->value(),
            $data['name']
        ));

        header('Location: /subject/create');
        exit;
    }

    public function assignTeacher(): void
    {
        $subjects = $this->subjectRepo->findAll();
        $teachers = $this->teacherRepo->findAll();
        $response = (new Response())->html('subjects/assign_teacher', [
            'subjects' => $subjects,
            'teachers' => $teachers,
        ]);
        $response->send();
    }

    public function storeAssignTeacher(): void
    {
        $data = $_POST;

        $handler = new AssignTeacherToSubjectHandler($this->teacherRepo, $this->subjectRepo);
        $handler->handle(new AssignTeacherToSubjectCommand(
            $data['teacher_id'],
            $data['subject_id']
        ));

        header('Location: /subject/assign-teacher');
        exit;
    }
}
