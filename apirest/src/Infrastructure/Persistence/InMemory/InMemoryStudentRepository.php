<?php

namespace App\Infrastructure\Persistence\InMemory;

use App\Domain\Student\Student;
use App\Domain\Student\StudentId;
use App\Domain\Student\StudentRepository;

class InMemoryStudentRepository implements StudentRepository
{
    private array $students = [];

    public function save(Student $student): void
    {
        $this->students[$student->id()->value()] = $student;
    }

    public function find(StudentId $id): ?Student
    {
        return $this->students[$id->value()] ?? null;
    }

    public function findAll(): array
    {
        return array_values($this->students);
    }

    public function delete(StudentId $id): void
    {
        unset($this->students[$id->value()]);
    }
}
