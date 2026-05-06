<?php

namespace Tests\Domain\Course;

use PHPUnit\Framework\TestCase;

use App\Domain\Course\Course;
use App\Domain\Course\CourseId;

class CourseTest extends TestCase
{
    public function test_course_can_be_created(): void
    {
        $course = new Course(CourseId::generate(), 'DDD in PHP');
        $course->create();
        $this->assertFalse($course->isAvailable());
    }

    public function test_creating_an_already_created_course_throws_exception(): void
    {
        $this->expectException(\DomainException::class);

        $course = new Course(
            CourseId::generate(),
            'DDD in PHP'
        );

        $course->create();
        $course->create();
    }
}
