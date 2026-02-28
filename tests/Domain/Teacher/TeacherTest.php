<?php

namespace Tests\Domain\Teacher;

use App\Domain\Teacher\Teacher;
use App\Domain\Teacher\TeacherId;
use PHPUnit\Framework\TestCase;

class TeacherTest extends TestCase
{
    public function test_teacher_can_be_created(): void
    {
        $teacher = new Teacher(TeacherId::generate(), 'Maria López', 'maria@escola.cat');

        $this->assertEquals('Maria López', $teacher->name());
        $this->assertEquals('maria@escola.cat', $teacher->email());
    }

    public function test_teacher_id_cannot_be_empty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new TeacherId('');
    }
}
