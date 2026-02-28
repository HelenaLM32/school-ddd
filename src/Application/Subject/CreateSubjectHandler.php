<?php

namespace App\Application\Subject;

use App\Domain\Subject\Subject;
use App\Domain\Subject\SubjectId;
use App\Domain\Subject\SubjectRepository;

final class CreateSubjectHandler
{
    public function __construct(
        private readonly SubjectRepository $subjectRepository
    ) {}

    public function handle(CreateSubjectCommand $command): void
    {
        $subject = new Subject(
            new SubjectId($command->subjectId),
            $command->name
        );

        $this->subjectRepository->save($subject);
    }
}
