<?php

namespace App\Application\Course;

use App\Domain\Course\Course;
use App\Domain\Course\CourseId;
use App\Domain\Course\CourseRepository;

final class CreateCourseHandler
{
    public function __construct(
        private readonly CourseRepository $courseRepository
    ) {}

    public function handle(CreateCourseCommand $command): void
    {
        $course = new Course(
            new CourseId($command->courseId),
            $command->name
        );

        $this->courseRepository->save($course);
    }
}
