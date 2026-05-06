<?php

namespace App\Infrastructure\Persistence\InMemory;

use App\Domain\Course\CourseId;
use App\Domain\Course\Course;
use App\Domain\Course\CourseRepository;

class InMemoryCourseRepository implements CourseRepository
{
    private array $courses = [];

    public function save(Course $course): void
    {
        $this->courses[$course->id()->value()] = $course;
    }

    public function find(CourseId $id): ?Course
    {
        return $this->courses[$id->value()] ?? null;
    }

    public function findAll(): array
    {
        return array_values($this->courses);
    }
}
