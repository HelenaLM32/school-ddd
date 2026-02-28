<?php

namespace App\Domain\Teacher;

interface TeacherRepository
{
    public function save(Teacher $teacher): void;
    public function find(TeacherId $id): ?Teacher;
    public function findAll(): array;
}
