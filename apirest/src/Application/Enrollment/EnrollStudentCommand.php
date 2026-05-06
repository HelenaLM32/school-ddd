<?php

namespace App\Application\Enrollment;

final class EnrollStudentCommand
{
    public function __construct(
        public readonly string $studentId,
        public readonly string $subjectId
    ) {}
}
