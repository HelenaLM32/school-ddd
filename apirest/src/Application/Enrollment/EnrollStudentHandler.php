<?php

namespace App\Application\Enrollment;

use App\Domain\Student\StudentId;
use App\Domain\Student\StudentRepository;
use App\Domain\Subject\SubjectId;
use App\Domain\Subject\SubjectRepository;

final class EnrollStudentHandler
{
    public function __construct(
        private readonly StudentRepository $studentRepository,
        private readonly SubjectRepository $subjectRepository
    ) {}

    public function handle(EnrollStudentCommand $command): void
    {
        $studentId = new StudentId($command->studentId);
        $subjectId = new SubjectId($command->subjectId);

        $student = $this->studentRepository->find($studentId);
        if ($student === null) {
            throw new \DomainException("Student not found: {$command->studentId}");
        }

        $subject = $this->subjectRepository->find($subjectId);
        if ($subject === null) {
            throw new \DomainException("Subject not found: {$command->subjectId}");
        }

        $subject->enrollStudent($studentId);

        $this->subjectRepository->save($subject);
    }
}
