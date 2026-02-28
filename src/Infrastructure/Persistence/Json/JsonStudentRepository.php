<?php

namespace App\Infrastructure\Persistence\Json;

use App\Domain\Student\Student;
use App\Domain\Student\StudentId;
use App\Domain\Student\StudentRepository;

class JsonStudentRepository implements StudentRepository
{
    private array $students = [];
    private string $filePath;

    public function __construct()
    {
        $this->filePath = __DIR__ . '/../../../../../../data/students.json';
        $this->load();
    }

    private function load(): void
    {
        if (!file_exists($this->filePath)) return;
        $data = json_decode(file_get_contents($this->filePath), true) ?? [];
        foreach ($data as $item) {
            $this->students[$item['id']] = new Student(
                new StudentId($item['id']),
                $item['name'],
                $item['email']
            );
        }
    }

    private function persist(): void
    {
        $dir = dirname($this->filePath);
        if (!is_dir($dir)) mkdir($dir, 0755, true);

        $data = array_map(fn($s) => [
            'id'    => $s->id()->value(),
            'name'  => $s->name(),
            'email' => $s->email(),
        ], $this->students);

        file_put_contents($this->filePath, json_encode(array_values($data), JSON_PRETTY_PRINT));
    }

    public function save(Student $student): void
    {
        $this->students[$student->id()->value()] = $student;
        $this->persist();
    }

    public function find(StudentId $id): ?Student
    {
        return $this->students[$id->value()] ?? null;
    }

    public function findAll(): array
    {
        return array_values($this->students);
    }
}
