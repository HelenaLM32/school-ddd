<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Course\Course;
use App\Domain\Course\CourseId;
use App\Domain\Course\CourseRepository;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineCourseRepository implements CourseRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function find(CourseId $id): ?Course
    {
        return $this->entityManager
            ->getRepository(Course::class)
            ->find($id->value());
    }

    public function save(Course $course): void
    {
        $this->entityManager->persist($course);
        $this->entityManager->flush();
    }

    public function findAll(): array
    {
        return $this->entityManager
            ->getRepository(Course::class)
            ->findAll();
    }

    public function delete(CourseId $id): void
    {
        $course = $this->find($id);
        if ($course) {
            $this->entityManager->remove($course);
            $this->entityManager->flush();
        }
    }
}
