<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

/**
 * Tests de funcionalitat dels Endpoints de l'API school-ddd.
 *
 * Executa amb: php artisan test --filter ApiEndpointsTest
 *
 * Requereix que l'API school-ddd estigui en marxa a API_BASE_URL.
 */
class ApiEndpointsTest extends TestCase
{
    private string $base;

    // IDs únics per als tests (s'esborren al teardown)
    private string $teacherId = 'test-teacher-phpunit-001';
    private string $studentId = 'test-student-phpunit-001';
    private string $subjectId = 'test-subject-phpunit-001';

    protected function setUp(): void
    {
        parent::setUp();
        $this->base = rtrim(env('API_BASE_URL', 'http://localhost:8000'), '/');
    }

    protected function tearDown(): void
    {
        // Netejar dades de test
        Http::delete("{$this->base}/api/teachers/{$this->teacherId}");
        Http::delete("{$this->base}/api/students/{$this->studentId}");
        Http::delete("{$this->base}/api/subjects/{$this->subjectId}");
        parent::tearDown();
    }

    // ─────────────────────────────────────────────────────────────────────────
    // TEACHERS
    // ─────────────────────────────────────────────────────────────────────────

    /** @test */
    public function it_gets_all_teachers(): void
    {
        $response = Http::get("{$this->base}/api/teachers");

        $this->assertTrue($response->successful(), 'GET /api/teachers should return 2xx');
        $this->assertIsArray($response->json(), 'Response should be an array');
    }

    /** @test */
    public function it_creates_a_teacher(): void
    {
        $response = Http::post("{$this->base}/api/teachers", [
            'id'   => $this->teacherId,
            'name' => 'PHPUnit Teacher',
        ]);

        $this->assertTrue($response->successful(), 'POST /api/teachers should return 2xx');
    }

    /** @test */
    public function it_gets_a_single_teacher(): void
    {
        Http::post("{$this->base}/api/teachers", [
            'id'   => $this->teacherId,
            'name' => 'PHPUnit Teacher',
        ]);

        $response = Http::get("{$this->base}/api/teachers/{$this->teacherId}");

        $this->assertTrue($response->successful(), 'GET /api/teachers/{id} should return 2xx');
    }

    /** @test */
    public function it_updates_a_teacher(): void
    {
        Http::post("{$this->base}/api/teachers", [
            'id'   => $this->teacherId,
            'name' => 'PHPUnit Teacher',
        ]);

        $response = Http::put("{$this->base}/api/teachers/{$this->teacherId}", [
            'name' => 'PHPUnit Teacher Updated',
        ]);

        $this->assertTrue($response->successful(), 'PUT /api/teachers/{id} should return 2xx');
    }

    /** @test */
    public function it_deletes_a_teacher(): void
    {
        Http::post("{$this->base}/api/teachers", [
            'id'   => $this->teacherId,
            'name' => 'PHPUnit Teacher',
        ]);

        $response = Http::delete("{$this->base}/api/teachers/{$this->teacherId}");

        $this->assertTrue($response->successful(), 'DELETE /api/teachers/{id} should return 2xx');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // STUDENTS
    // ─────────────────────────────────────────────────────────────────────────

    /** @test */
    public function it_gets_all_students(): void
    {
        $response = Http::get("{$this->base}/api/students");

        $this->assertTrue($response->successful(), 'GET /api/students should return 2xx');
        $this->assertIsArray($response->json());
    }

    /** @test */
    public function it_creates_a_student(): void
    {
        $response = Http::post("{$this->base}/api/students", [
            'id'   => $this->studentId,
            'name' => 'PHPUnit Student',
        ]);

        $this->assertTrue($response->successful(), 'POST /api/students should return 2xx');
    }

    /** @test */
    public function it_gets_a_single_student(): void
    {
        Http::post("{$this->base}/api/students", [
            'id'   => $this->studentId,
            'name' => 'PHPUnit Student',
        ]);

        $response = Http::get("{$this->base}/api/students/{$this->studentId}");

        $this->assertTrue($response->successful(), 'GET /api/students/{id} should return 2xx');
    }

    /** @test */
    public function it_updates_a_student(): void
    {
        Http::post("{$this->base}/api/students", [
            'id'   => $this->studentId,
            'name' => 'PHPUnit Student',
        ]);

        $response = Http::put("{$this->base}/api/students/{$this->studentId}", [
            'name' => 'PHPUnit Student Updated',
        ]);

        $this->assertTrue($response->successful(), 'PUT /api/students/{id} should return 2xx');
    }

    /** @test */
    public function it_deletes_a_student(): void
    {
        Http::post("{$this->base}/api/students", [
            'id'   => $this->studentId,
            'name' => 'PHPUnit Student',
        ]);

        $response = Http::delete("{$this->base}/api/students/{$this->studentId}");

        $this->assertTrue($response->successful(), 'DELETE /api/students/{id} should return 2xx');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // SUBJECTS
    // ─────────────────────────────────────────────────────────────────────────

    /** @test */
    public function it_gets_all_subjects(): void
    {
        $response = Http::get("{$this->base}/api/subjects");

        $this->assertTrue($response->successful(), 'GET /api/subjects should return 2xx');
        $this->assertIsArray($response->json());
    }

    /** @test */
    public function it_creates_a_subject(): void
    {
        $response = Http::post("{$this->base}/api/subjects", [
            'id'   => $this->subjectId,
            'name' => 'PHPUnit Subject',
        ]);

        $this->assertTrue($response->successful(), 'POST /api/subjects should return 2xx');
    }

    /** @test */
    public function it_gets_a_single_subject(): void
    {
        Http::post("{$this->base}/api/subjects", [
            'id'   => $this->subjectId,
            'name' => 'PHPUnit Subject',
        ]);

        $response = Http::get("{$this->base}/api/subjects/{$this->subjectId}");

        $this->assertTrue($response->successful(), 'GET /api/subjects/{id} should return 2xx');
    }

    /** @test */
    public function it_updates_a_subject(): void
    {
        Http::post("{$this->base}/api/subjects", [
            'id'   => $this->subjectId,
            'name' => 'PHPUnit Subject',
        ]);

        $response = Http::put("{$this->base}/api/subjects/{$this->subjectId}", [
            'name' => 'PHPUnit Subject Updated',
        ]);

        $this->assertTrue($response->successful(), 'PUT /api/subjects/{id} should return 2xx');
    }

    /** @test */
    public function it_assigns_a_teacher_to_a_subject(): void
    {
        Http::post("{$this->base}/api/teachers", [
            'id'   => $this->teacherId,
            'name' => 'PHPUnit Teacher',
        ]);
        Http::post("{$this->base}/api/subjects", [
            'id'   => $this->subjectId,
            'name' => 'PHPUnit Subject',
        ]);

        $response = Http::post(
            "{$this->base}/api/subjects/{$this->subjectId}/assign-teacher",
            ['teacher_id' => $this->teacherId]
        );

        $this->assertTrue($response->successful(), 'POST /api/subjects/{id}/assign-teacher should return 2xx');
    }

    /** @test */
    public function it_deletes_a_subject(): void
    {
        Http::post("{$this->base}/api/subjects", [
            'id'   => $this->subjectId,
            'name' => 'PHPUnit Subject',
        ]);

        $response = Http::delete("{$this->base}/api/subjects/{$this->subjectId}");

        $this->assertTrue($response->successful(), 'DELETE /api/subjects/{id} should return 2xx');
    }
}
