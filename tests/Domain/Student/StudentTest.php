<?php

namespace Tests\Domain\Student;

use App\Domain\Student\Student;
use App\Domain\Student\StudentId;
use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase
{
    public function test_student_can_be_created(): void
    {
        $student = new Student(StudentId::generate(), 'Joan Garcia', 'joan@escola.cat');

        $this->assertEquals('Joan Garcia', $student->name());
        $this->assertEquals('joan@escola.cat', $student->email());
    }

    public function test_student_id_cannot_be_empty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new StudentId('');
    }
}
