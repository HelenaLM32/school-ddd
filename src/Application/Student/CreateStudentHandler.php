<?php

namespace App\Application\Student;

use App\Domain\Student\Student;
use App\Domain\Student\StudentId;
use App\Domain\Student\StudentRepository;

final class CreateStudentHandler
{
    public function __construct(
        private readonly StudentRepository $studentRepository
    ) {}

    public function handle(CreateStudentCommand $command): void
    {
        $student = new Student(
            new StudentId($command->studentId),
            $command->name,
            $command->email
        );

        $this->studentRepository->save($student);
    }
}
