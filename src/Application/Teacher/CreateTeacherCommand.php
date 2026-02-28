<?php

namespace App\Application\Teacher;

final class CreateTeacherCommand
{
    public function __construct(
        public readonly string $teacherId,
        public readonly string $name,
        public readonly string $email
    ) {}
}
