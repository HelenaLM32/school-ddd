<?php

namespace App\Controllers\Enrollment;

use App\Application\Enrollment\EnrollStudentCommand;
use App\Application\Enrollment\EnrollStudentHandler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Infrastructure\Persistence\Json\JsonStudentRepository;
use App\Infrastructure\Persistence\Json\JsonSubjectRepository;

class EnrollmentController
{
    private JsonStudentRepository $studentRepo;
    private JsonSubjectRepository $subjectRepo;

    public function __construct(private Request $request)
    {
        $this->studentRepo = new JsonStudentRepository();
        $this->subjectRepo = new JsonSubjectRepository();
    }

    public function create(): void
    {
        $students = $this->studentRepo->findAll();
        $subjects = $this->subjectRepo->findAll();
        $response = (new Response())->html('enrollment/create', [
            'students' => $students,
            'subjects' => $subjects,
        ]);
        $response->send();
    }

    public function store(): void
    {
        $data = $_POST;

        $handler = new EnrollStudentHandler($this->studentRepo, $this->subjectRepo);
        $handler->handle(new EnrollStudentCommand(
            $data['student_id'],
            $data['subject_id']
        ));

        header('Location: /enrollment/create');
        exit;
    }
}
