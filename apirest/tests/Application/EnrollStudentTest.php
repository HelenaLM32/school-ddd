<?php

namespace Tests\Application;

use App\Application\Enrollment\EnrollStudentCommand;
use App\Application\Enrollment\EnrollStudentHandler;
use App\Domain\Student\Student;
use App\Domain\Student\StudentId;
use App\Domain\Student\StudentRepository;
use App\Domain\Subject\Subject;
use App\Domain\Subject\SubjectId;
use App\Domain\Subject\SubjectRepository;
use PHPUnit\Framework\Attributes\DisableReturnValueGenerationForTestDoubles;
use PHPUnit\Framework\TestCase;

#[DisableReturnValueGenerationForTestDoubles]
final class EnrollStudentTest extends TestCase
{
    public function test_student_can_be_enrolled_in_a_subject(): void
    {
        $studentId = new StudentId('STU-1');
        $subjectId = new SubjectId('SUB-1');

        $student = new Student($studentId, 'Joan Garcia', 'joan@escola.cat');
        $subject = new Subject($subjectId, 'Matemàtiques');

        $studentRepo = $this->createStub(StudentRepository::class);
        $studentRepo->method('find')->willReturn($student);

        $subjectRepo = $this->createMock(SubjectRepository::class);
        $subjectRepo->method('find')->willReturn($subject);
        $subjectRepo->expects($this->once())->method('save');

        $handler = new EnrollStudentHandler($studentRepo, $subjectRepo);
        $handler->handle(new EnrollStudentCommand('STU-1', 'SUB-1'));

        $this->assertTrue($subject->isStudentEnrolled($studentId));
    }

    public function test_enrolling_student_not_found_throws_exception(): void
    {
        $this->expectException(\DomainException::class);

        $studentRepo = $this->createStub(StudentRepository::class);
        $studentRepo->method('find')->willReturn(null);

        $subjectRepo = $this->createStub(SubjectRepository::class);

        $handler = new EnrollStudentHandler($studentRepo, $subjectRepo);
        $handler->handle(new EnrollStudentCommand('STU-X', 'SUB-1'));
    }

    public function test_enrolling_in_nonexistent_subject_throws_exception(): void
    {
        $this->expectException(\DomainException::class);

        $student = new Student(new StudentId('STU-1'), 'Joan Garcia', 'joan@escola.cat');

        $studentRepo = $this->createStub(StudentRepository::class);
        $studentRepo->method('find')->willReturn($student);

        $subjectRepo = $this->createStub(SubjectRepository::class);
        $subjectRepo->method('find')->willReturn(null);

        $handler = new EnrollStudentHandler($studentRepo, $subjectRepo);
        $handler->handle(new EnrollStudentCommand('STU-1', 'SUB-X'));
    }

    public function test_enrolling_same_student_twice_throws_exception(): void
    {
        $this->expectException(\DomainException::class);

        $studentId = new StudentId('STU-1');
        $student   = new Student($studentId, 'Joan Garcia', 'joan@escola.cat');
        $subject   = new Subject(new SubjectId('SUB-1'), 'Matemàtiques');
        $subject->enrollStudent($studentId);

        $studentRepo = $this->createStub(StudentRepository::class);
        $studentRepo->method('find')->willReturn($student);

        $subjectRepo = $this->createStub(SubjectRepository::class);
        $subjectRepo->method('find')->willReturn($subject);

        $handler = new EnrollStudentHandler($studentRepo, $subjectRepo);
        $handler->handle(new EnrollStudentCommand('STU-1', 'SUB-1'));
    }
}
