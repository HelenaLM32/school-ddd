<?php

namespace Tests\Application;

use App\Application\Course\CreateCourseCommand;
use App\Application\Course\CreateCourseHandler;
use App\Domain\Course\CourseRepository;
use PHPUnit\Framework\Attributes\DisableReturnValueGenerationForTestDoubles;
use PHPUnit\Framework\TestCase;

#[DisableReturnValueGenerationForTestDoubles]
final class CreateCourseTest extends TestCase
{
    public function test_course_can_be_created(): void
    {
        $courseRepository = $this->createMock(CourseRepository::class);
        $courseRepository->expects($this->once())->method('save');

        $handler = new CreateCourseHandler($courseRepository);
        $command = new CreateCourseCommand('CURSO-1', 'PHP');
        $handler->handle($command);
    }
}
