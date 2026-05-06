<?php

namespace App\Application\Course;

final class CreateCourseCommand
{
    public function __construct(
        public readonly string $courseId,
        public readonly string $name
    ) {}
}
