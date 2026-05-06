<?php

namespace App\Application\Subject;

final class AssignTeacherToSubjectCommand
{
    public function __construct(
        public readonly string $teacherId,
        public readonly string $subjectId
    ) {}
}
