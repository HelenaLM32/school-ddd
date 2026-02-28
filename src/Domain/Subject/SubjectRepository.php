<?php

namespace App\Domain\Subject;

interface SubjectRepository
{
    public function save(Subject $subject): void;
    public function find(SubjectId $id): ?Subject;
    public function findAll(): array;
}
