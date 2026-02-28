<?php

namespace Tests\Application;

use App\Application\Student\CreateStudentCommand;
use App\Application\Student\CreateStudentHandler;
use App\Domain\Student\StudentRepository;
use PHPUnit\Framework\Attributes\DisableReturnValueGenerationForTestDoubles;
use PHPUnit\Framework\TestCase;

#[DisableReturnValueGenerationForTestDoubles]
final class CreateStudentTest extends TestCase
{
    public function test_student_can_be_created(): void
    {
        $repository = $this->createMock(StudentRepository::class);
        $repository->expects($this->once())->method('save');

        $handler = new CreateStudentHandler($repository);
        $command = new CreateStudentCommand('STU-1', 'Joan Garcia', 'joan@escola.cat');
        $handler->handle($command);
    }
}
