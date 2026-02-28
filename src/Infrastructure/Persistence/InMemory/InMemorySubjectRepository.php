<?php

namespace App\Infrastructure\Persistence\InMemory;

use App\Domain\Subject\Subject;
use App\Domain\Subject\SubjectId;
use App\Domain\Subject\SubjectRepository;

class InMemorySubjectRepository implements SubjectRepository
{
    private array $subjects = [];

    public function save(Subject $subject): void
    {
        $this->subjects[$subject->id()->value()] = $subject;
    }

    public function find(SubjectId $id): ?Subject
    {
        return $this->subjects[$id->value()] ?? null;
    }

    public function findAll(): array
    {
        return array_values($this->subjects);
    }
}
