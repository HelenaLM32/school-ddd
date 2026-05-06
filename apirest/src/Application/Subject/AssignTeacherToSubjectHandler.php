<?php

namespace App\Application\Subject;

use App\Domain\Teacher\TeacherId;
use App\Domain\Teacher\TeacherRepository;
use App\Domain\Subject\SubjectId;
use App\Domain\Subject\SubjectRepository;

final class AssignTeacherToSubjectHandler
{
    public function __construct(
        private readonly TeacherRepository $teacherRepository,
        private readonly SubjectRepository $subjectRepository
    ) {}

    public function handle(AssignTeacherToSubjectCommand $command): void
    {
        $teacherId = new TeacherId($command->teacherId);
        $subjectId = new SubjectId($command->subjectId);

        $teacher = $this->teacherRepository->find($teacherId);
        if ($teacher === null) {
            throw new \DomainException("Teacher not found: {$command->teacherId}");
        }

        $subject = $this->subjectRepository->find($subjectId);
        if ($subject === null) {
            throw new \DomainException("Subject not found: {$command->subjectId}");
        }

        $subject->assignTeacher($teacherId);

        $this->subjectRepository->save($subject);
    }
}
