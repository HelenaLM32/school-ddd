<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Student\Student;
use App\Domain\Student\StudentId;
use App\Domain\Student\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineStudentRepository implements StudentRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function find(StudentId $id): ?Student
    {
        return $this->entityManager
            ->getRepository(Student::class)
            ->find($id->value());
    }

    public function save(Student $Student): void
    {
        $this->entityManager->persist($Student);
        $this->entityManager->flush();
    }

    public function findAll(): array
    {
        return $this->entityManager
            ->getRepository(Student::class)
            ->findAll();
    }

    public function delete(StudentId $id): void
    {
        $Student = $this->find($id);
        if ($Student) {
            $this->entityManager->remove($Student);
            $this->entityManager->flush();
        }
    }
}
