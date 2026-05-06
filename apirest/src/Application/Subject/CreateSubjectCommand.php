<?php

namespace App\Application\Subject;

final class CreateSubjectCommand
{
    public function __construct(
        public readonly string $subjectId,
        public readonly string $name
    ) {}
}
