<?php

namespace Tests\Application;

use App\Application\Subject\CreateSubjectCommand;
use App\Application\Subject\CreateSubjectHandler;
use App\Domain\Subject\SubjectRepository;
use PHPUnit\Framework\Attributes\DisableReturnValueGenerationForTestDoubles;
use PHPUnit\Framework\TestCase;

#[DisableReturnValueGenerationForTestDoubles]
final class CreateSubjectTest extends TestCase
{
    public function test_subject_can_be_created(): void
    {
        $repository = $this->createMock(SubjectRepository::class);
        $repository->expects($this->once())->method('save');

        $handler = new CreateSubjectHandler($repository);
        $command = new CreateSubjectCommand('SUB-1', 'Matemàtiques');
        $handler->handle($command);
    }
}
