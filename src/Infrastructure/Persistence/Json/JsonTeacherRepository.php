<?php

namespace App\Infrastructure\Persistence\Json;

use App\Domain\Teacher\Teacher;
use App\Domain\Teacher\TeacherId;
use App\Domain\Teacher\TeacherRepository;

class JsonTeacherRepository implements TeacherRepository
{
    private array $teachers = [];
    private string $filePath;

    public function __construct()
    {
        $this->filePath = __DIR__ . '/../../../../../../data/teachers.json';
        $this->load();
    }

    private function load(): void
    {
        if (!file_exists($this->filePath)) return;
        $data = json_decode(file_get_contents($this->filePath), true) ?? [];
        foreach ($data as $item) {
            $this->teachers[$item['id']] = new Teacher(
                new TeacherId($item['id']),
                $item['name'],
                $item['email']
            );
        }
    }

    private function persist(): void
    {
        $dir = dirname($this->filePath);
        if (!is_dir($dir)) mkdir($dir, 0755, true);

        $data = array_map(fn($t) => [
            'id'    => $t->id()->value(),
            'name'  => $t->name(),
            'email' => $t->email(),
        ], $this->teachers);

        file_put_contents($this->filePath, json_encode(array_values($data), JSON_PRETTY_PRINT));
    }

    public function save(Teacher $teacher): void
    {
        $this->teachers[$teacher->id()->value()] = $teacher;
        $this->persist();
    }

    public function find(TeacherId $id): ?Teacher
    {
        return $this->teachers[$id->value()] ?? null;
    }

    public function findAll(): array
    {
        return array_values($this->teachers);
    }
}
