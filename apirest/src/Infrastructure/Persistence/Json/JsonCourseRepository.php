<?php

namespace App\Infrastructure\Persistence\Json;

use App\Domain\Course\Course;
use App\Domain\Course\CourseId;
use App\Domain\Course\CourseRepository;

class JsonCourseRepository implements CourseRepository
{
    private array $courses = [];
    private string $filePath;

    public function __construct()
    {
        $this->filePath = __DIR__ . '/../../../../../../data/courses.json';
        $this->load();
    }

    private function load(): void
    {
        if (!file_exists($this->filePath)) return;
        $data = json_decode(file_get_contents($this->filePath), true) ?? [];
        foreach ($data as $item) {
            $this->courses[$item['id']] = new Course(
                new CourseId($item['id']),
                $item['name']
            );
        }
    }

    private function persist(): void
    {
        $dir = dirname($this->filePath);
        if (!is_dir($dir)) mkdir($dir, 0755, true);

        $data = array_map(fn($c) => [
            'id'   => $c->id()->value(),
            'name' => $c->name(),
        ], $this->courses);

        file_put_contents($this->filePath, json_encode(array_values($data), JSON_PRETTY_PRINT));
    }

    public function save(Course $course): void
    {
        $this->courses[$course->id()->value()] = $course;
        $this->persist();
    }

    public function find(CourseId $id): ?Course
    {
        return $this->courses[$id->value()] ?? null;
    }

    public function findAll(): array
    {
        return array_values($this->courses);
    }

    public function delete(CourseId $id): void
    {
        unset($this->courses[$id->value()]);
        $this->persist();
    }
}
