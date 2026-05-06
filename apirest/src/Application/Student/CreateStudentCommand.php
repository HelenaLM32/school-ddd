<?php

namespace App\Application\Student;

final class CreateStudentCommand
{
    public function __construct(
        public readonly string $studentId,
        public readonly string $name,
        public readonly string $email
    ) {}
}
