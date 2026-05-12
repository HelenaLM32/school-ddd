<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class ApiService
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('app.api_base_url', env('API_BASE_URL', 'http://localhost:8000')), '/');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // TEACHERS
    // ─────────────────────────────────────────────────────────────────────────

    public function getTeachers(): array
    {
        $response = Http::timeout(10)->get("{$this->baseUrl}/api/teachers");
        return $this->handleCollection($response);
    }

    public function getTeacher(string $id): ?array
    {
        $response = Http::timeout(10)->get("{$this->baseUrl}/api/teachers/{$id}");
        return $this->handleItem($response);
    }

    public function createTeacher(array $data): array
    {
        $response = Http::timeout(10)->post("{$this->baseUrl}/api/teachers", $data);
        return $this->handleItem($response) ?? [];
    }

    public function updateTeacher(string $id, array $data): array
    {
        $response = Http::timeout(10)->put("{$this->baseUrl}/api/teachers/{$id}", $data);
        return $this->handleItem($response) ?? [];
    }

    public function deleteTeacher(string $id): bool
    {
        $response = Http::timeout(10)->delete("{$this->baseUrl}/api/teachers/{$id}");
        return $response->successful();
    }

    // ─────────────────────────────────────────────────────────────────────────
    // STUDENTS
    // ─────────────────────────────────────────────────────────────────────────

    public function getStudents(): array
    {
        $response = Http::timeout(10)->get("{$this->baseUrl}/api/students");
        return $this->handleCollection($response);
    }

    public function getStudent(string $id): ?array
    {
        $response = Http::timeout(10)->get("{$this->baseUrl}/api/students/{$id}");
        return $this->handleItem($response);
    }

    public function createStudent(array $data): array
    {
        $response = Http::timeout(10)->post("{$this->baseUrl}/api/students", $data);
        return $this->handleItem($response) ?? [];
    }

    public function updateStudent(string $id, array $data): array
    {
        $response = Http::timeout(10)->put("{$this->baseUrl}/api/students/{$id}", $data);
        return $this->handleItem($response) ?? [];
    }

    public function deleteStudent(string $id): bool
    {
        $response = Http::timeout(10)->delete("{$this->baseUrl}/api/students/{$id}");
        return $response->successful();
    }

    // ─────────────────────────────────────────────────────────────────────────
    // SUBJECTS
    // ─────────────────────────────────────────────────────────────────────────

    public function getSubjects(): array
    {
        $response = Http::timeout(10)->get("{$this->baseUrl}/api/subjects");
        return $this->handleCollection($response);
    }

    public function getSubject(string $id): ?array
    {
        $response = Http::timeout(10)->get("{$this->baseUrl}/api/subjects/{$id}");
        return $this->handleItem($response);
    }

    public function createSubject(array $data): array
    {
        $response = Http::timeout(10)->post("{$this->baseUrl}/api/subjects", $data);
        return $this->handleItem($response) ?? [];
    }

    public function updateSubject(string $id, array $data): array
    {
        $response = Http::timeout(10)->put("{$this->baseUrl}/api/subjects/{$id}", $data);
        return $this->handleItem($response) ?? [];
    }

    public function deleteSubject(string $id): bool
    {
        $response = Http::timeout(10)->delete("{$this->baseUrl}/api/subjects/{$id}");
        return $response->successful();
    }

    public function assignTeacherToSubject(string $subjectId, string $teacherId): array
    {
        $response = Http::timeout(10)->post(
            "{$this->baseUrl}/api/subjects/{$subjectId}/assign-teacher",
            ['teacherId' => $teacherId]
        );
        return $this->handleItem($response) ?? [];
    }

    // ─────────────────────────────────────────────────────────────────────────
    // HELPERS
    // ─────────────────────────────────────────────────────────────────────────

    /** Para respuestas de lista: devuelve el array dentro de 'data' */
    private function handleCollection(Response $response): array
    {
        if ($response->failed()) {
            return [];
        }
        return $response->json('data') ?? [];
    }

    private function handleItem(Response $response): ?array
    {
        if ($response->failed()) {
            // Opcional: loguear en Laravel para debug
            \Illuminate\Support\Facades\Log::warning('API error', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
            return null;
        }
        return $response->json('data') ?? null;
    }
}
