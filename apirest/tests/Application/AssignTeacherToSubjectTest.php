<?php

namespace Tests\Application;

use App\Application\Subject\AssignTeacherToSubjectCommand;
use App\Application\Subject\AssignTeacherToSubjectHandler;
use App\Domain\Teacher\Teacher;
use App\Domain\Teacher\TeacherId;
use App\Domain\Teacher\TeacherRepository;
use App\Domain\Subject\Subject;
use App\Domain\Subject\SubjectId;
use App\Domain\Subject\SubjectRepository;
use PHPUnit\Framework\Attributes\DisableReturnValueGenerationForTestDoubles;
use PHPUnit\Framework\TestCase;

#[DisableReturnValueGenerationForTestDoubles]
final class AssignTeacherToSubjectTest extends TestCase
{
    public function test_teacher_can_be_assigned_to_subject(): void
    {
        $teacherId = new TeacherId('TCH-1');
        $subjectId = new SubjectId('SUB-1');

        $teacher = new Teacher($teacherId, 'Maria López', 'maria@escola.cat');
        $subject = new Subject($subjectId, 'Matemàtiques');

        $teacherRepo = $this->createStub(TeacherRepository::class);
        $teacherRepo->method('find')->willReturn($teacher);

        $subjectRepo = $this->createMock(SubjectRepository::class);
        $subjectRepo->method('find')->willReturn($subject);
        $subjectRepo->expects($this->once())->method('save');

        $handler = new AssignTeacherToSubjectHandler($teacherRepo, $subjectRepo);
        $handler->handle(new AssignTeacherToSubjectCommand('TCH-1', 'SUB-1'));

        $this->assertEquals('TCH-1', $subject->teacherId()?->value());
    }

    public function test_assigning_nonexistent_teacher_throws_exception(): void
    {
        $this->expectException(\DomainException::class);

        $teacherRepo = $this->createStub(TeacherRepository::class);
        $teacherRepo->method('find')->willReturn(null);

        $subjectRepo = $this->createStub(SubjectRepository::class);

        $handler = new AssignTeacherToSubjectHandler($teacherRepo, $subjectRepo);
        $handler->handle(new AssignTeacherToSubjectCommand('TCH-X', 'SUB-1'));
    }

    public function test_assigning_teacher_to_nonexistent_subject_throws_exception(): void
    {
        $this->expectException(\DomainException::class);

        $teacher = new Teacher(new TeacherId('TCH-1'), 'Maria López', 'maria@escola.cat');

        $teacherRepo = $this->createStub(TeacherRepository::class);
        $teacherRepo->method('find')->willReturn($teacher);

        $subjectRepo = $this->createStub(SubjectRepository::class);
        $subjectRepo->method('find')->willReturn(null);

        $handler = new AssignTeacherToSubjectHandler($teacherRepo, $subjectRepo);
        $handler->handle(new AssignTeacherToSubjectCommand('TCH-1', 'SUB-X'));
    }
}
