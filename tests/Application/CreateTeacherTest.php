<?php

namespace Tests\Application;

use App\Application\Teacher\CreateTeacherCommand;
use App\Application\Teacher\CreateTeacherHandler;
use App\Domain\Teacher\TeacherRepository;
use PHPUnit\Framework\Attributes\DisableReturnValueGenerationForTestDoubles;
use PHPUnit\Framework\TestCase;

#[DisableReturnValueGenerationForTestDoubles]
final class CreateTeacherTest extends TestCase
{
    public function test_teacher_can_be_created(): void
    {
        $repository = $this->createMock(TeacherRepository::class);
        $repository->expects($this->once())->method('save');

        $handler = new CreateTeacherHandler($repository);
        $command = new CreateTeacherCommand('TCH-1', 'Maria López', 'maria@escola.cat');
        $handler->handle($command);
    }
}
