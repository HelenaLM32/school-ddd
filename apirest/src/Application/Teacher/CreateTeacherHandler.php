<?php

namespace App\Application\Teacher;

use App\Domain\Teacher\Teacher;
use App\Domain\Teacher\TeacherId;
use App\Domain\Teacher\TeacherRepository;

final class CreateTeacherHandler
{
    public function __construct(
        private readonly TeacherRepository $teacherRepository
    ) {}

    public function handle(CreateTeacherCommand $command): void
    {
        $teacher = new Teacher(
            new TeacherId($command->teacherId),
            $command->name,
            $command->email
        );

        $this->teacherRepository->save($teacher);
    }
}
