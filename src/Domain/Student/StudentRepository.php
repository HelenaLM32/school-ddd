<?php

namespace App\Domain\Student;

interface StudentRepository
{
    public function save(Student $student): void;
    public function find(StudentId $id): ?Student;
    public function findAll(): array;
}
