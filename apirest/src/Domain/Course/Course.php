<?php

namespace App\Domain\Course;


use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: 'courses')]
final class Course
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    private string $id;


    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'boolean')]
    private bool $available = true;


    public function __construct(CourseId $id, string $name)
    {
        $this->id = $id->value();
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function create(): void
    {
        if (!$this->available) {
            throw new \DomainException('Course not available');
        }


        $this->available = false;
    }
    public function id(): CourseId
    {
        return new CourseId($this->id);
    }

    public function return(): void
    {
        $this->available = true;
    }
    public function isAvailable(): bool
    {
        return $this->available;
    }
}
