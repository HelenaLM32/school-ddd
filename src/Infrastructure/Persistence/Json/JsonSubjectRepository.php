<?php

namespace App\Infrastructure\Persistence\Json;

use App\Domain\Subject\Subject;
use App\Domain\Subject\SubjectId;
use App\Domain\Subject\SubjectRepository;
use App\Domain\Teacher\TeacherId;
use App\Domain\Student\StudentId;

class JsonSubjectRepository implements SubjectRepository
{
    private array $subjects = [];
    private string $filePath;

    public function __construct()
    {
        $this->filePath = __DIR__ . '/../../../../../../data/subjects.json';
        $this->load();
    }

    private function load(): void
    {
        if (!file_exists($this->filePath)) return;
        $data = json_decode(file_get_contents($this->filePath), true) ?? [];
        foreach ($data as $item) {
            $subject = new Subject(new SubjectId($item['id']), $item['name']);
            if (!empty($item['teacherId'])) {
                $subject->assignTeacher(new TeacherId($item['teacherId']));
            }
            foreach ($item['enrolledStudentIds'] ?? [] as $studentId) {
                $subject->enrollStudent(new StudentId($studentId));
            }
            $this->subjects[$item['id']] = $subject;
        }
    }

    private function persist(): void
    {
        $dir = dirname($this->filePath);
        if (!is_dir($dir)) mkdir($dir, 0755, true);

        $data = array_map(fn($s) => [
            'id'                 => $s->id()->value(),
            'name'               => $s->name(),
            'teacherId'          => $s->teacherId()?->value(),
            'enrolledStudentIds' => $s->enrolledStudentIds(),
        ], $this->subjects);

        file_put_contents($this->filePath, json_encode(array_values($data), JSON_PRETTY_PRINT));
    }

    public function save(Subject $subject): void
    {
        $this->subjects[$subject->id()->value()] = $subject;
        $this->persist();
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
