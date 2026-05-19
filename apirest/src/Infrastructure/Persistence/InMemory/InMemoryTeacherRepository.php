<?php

namespace App\Infrastructure\Persistence\InMemory;

use App\Domain\Teacher\Teacher;
use App\Domain\Teacher\TeacherId;
use App\Domain\Teacher\TeacherRepository;

class InMemoryTeacherRepository implements TeacherRepository
{
    private array $teachers = [];

    public function save(Teacher $teacher): void
    {
        $this->teachers[$teacher->id()->value()] = $teacher;
    }

    public function find(TeacherId $id): ?Teacher
    {
        return $this->teachers[$id->value()] ?? null;
    }

    public function findAll(): array
    {
        return array_values($this->teachers);
    }

    public function delete(TeacherId $id): void
    {
        unset($this->teachers[$id->value()]);
    }
}
