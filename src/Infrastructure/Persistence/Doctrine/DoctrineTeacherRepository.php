<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Teacher\Teacher;
use App\Domain\Teacher\TeacherId;
use App\Domain\Teacher\TeacherRepository;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineTeacherRepository implements TeacherRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function find(TeacherId $id): ?Teacher
    {
        return $this->entityManager
            ->getRepository(Teacher::class)
            ->find($id->value());
    }

    public function save(Teacher $Teacher): void
    {
        $this->entityManager->persist($Teacher);
        $this->entityManager->flush();
    }

    public function findAll(): array
    {
        return $this->entityManager
            ->getRepository(Teacher::class)
            ->findAll();
    }

    public function delete(TeacherId $id): void
    {
        $Teacher = $this->find($id);
        if ($Teacher) {
            $this->entityManager->remove($Teacher);
            $this->entityManager->flush();
        }
    }
}
