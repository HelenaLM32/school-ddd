<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Subject\Subject;
use App\Domain\Subject\SubjectId;
use App\Domain\Subject\SubjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineSubjectRepository implements SubjectRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function find(SubjectId $id): ?Subject
    {
        return $this->entityManager
            ->getRepository(Subject::class)
            ->find($id->value());
    }

    public function save(Subject $Subject): void
    {
        $this->entityManager->persist($Subject);
        $this->entityManager->flush();
    }

    public function findAll(): array
    {
        return $this->entityManager
            ->getRepository(Subject::class)
            ->findAll();
    }

    public function delete(SubjectId $id): void
    {
        $Subject = $this->find($id);
        if ($Subject) {
            $this->entityManager->remove($Subject);
            $this->entityManager->flush();
        }
    }
}
