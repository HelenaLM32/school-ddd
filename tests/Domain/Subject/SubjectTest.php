<?php

namespace Tests\Domain\Subject;

use App\Domain\Student\StudentId;
use App\Domain\Teacher\TeacherId;
use App\Domain\Subject\Subject;
use App\Domain\Subject\SubjectId;
use PHPUnit\Framework\TestCase;

class SubjectTest extends TestCase
{
    public function test_subject_can_be_created(): void
    {
        $subject = new Subject(SubjectId::generate(), 'Matemàtiques');

        $this->assertEquals('Matemàtiques', $subject->name());
        $this->assertNull($subject->teacherId());
        $this->assertEmpty($subject->enrolledStudentIds());
    }

    public function test_teacher_can_be_assigned(): void
    {
        $subject   = new Subject(SubjectId::generate(), 'Física');
        $teacherId = new TeacherId('TCH-1');

        $subject->assignTeacher($teacherId);

        $this->assertEquals('TCH-1', $subject->teacherId()->value());
    }

    public function test_student_can_be_enrolled(): void
    {
        $subject   = new Subject(SubjectId::generate(), 'Física');
        $studentId = new StudentId('STU-1');

        $subject->enrollStudent($studentId);

        $this->assertTrue($subject->isStudentEnrolled($studentId));
    }

    public function test_same_student_cannot_be_enrolled_twice(): void
    {
        $this->expectException(\DomainException::class);

        $subject   = new Subject(SubjectId::generate(), 'Física');
        $studentId = new StudentId('STU-1');

        $subject->enrollStudent($studentId);
        $subject->enrollStudent($studentId);
    }

    public function test_subject_id_cannot_be_empty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new SubjectId('');
    }
}
