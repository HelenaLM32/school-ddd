<?php

namespace App\Domain\Subject;

use App\Domain\Student\StudentId;
use App\Domain\Teacher\TeacherId;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'subjects')]
final class Subject
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    private string $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string', length: 36, nullable: true)]
    private ?string $teacherId = null;

    /** @var string[] */
    #[ORM\Column(type: 'json')]
    private array $enrolledStudentIds = [];

    public function __construct(SubjectId $id, string $name)
    {
        $this->id   = $id->value();
        $this->name = $name;
    }

    public function id(): SubjectId
    {
        return new SubjectId($this->id);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function teacherId(): ?TeacherId
    {
        return $this->teacherId !== null ? new TeacherId($this->teacherId) : null;
    }

    public function assignTeacher(TeacherId $teacherId): void
    {
        $this->teacherId = $teacherId->value();
    }

    public function enrollStudent(StudentId $studentId): void
    {
        if (in_array($studentId->value(), $this->enrolledStudentIds, true)) {
            throw new \DomainException(
                "Student {$studentId->value()} is already enrolled in this subject."
            );
        }
        $this->enrolledStudentIds[] = $studentId->value();
    }

    public function enrolledStudentIds(): array
    {
        return $this->enrolledStudentIds;
    }

    public function isStudentEnrolled(StudentId $studentId): bool
    {
        return in_array($studentId->value(), $this->enrolledStudentIds, true);
    }


    public function rename(string $name): void
    {
        $this->name = $name;
    }
}
