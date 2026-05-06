<?php

use App\Controllers\Api\ApiTeacherController;
use App\Controllers\Api\ApiStudentController;
use App\Controllers\Api\ApiSubjectController;
use App\Controllers\Api\ApiCourseController;

return [

    // ── API REST ─────────────────────────────────────────────────────────────

    // API Teachers
    ['method' => 'GET',    'path' => '/api/teachers',         'handler' => [ApiTeacherController::class, 'index']],
    ['method' => 'GET',    'path' => '/api/teachers/{id}',    'handler' => [ApiTeacherController::class, 'show']],
    ['method' => 'POST',   'path' => '/api/teachers',         'handler' => [ApiTeacherController::class, 'store']],
    ['method' => 'PUT',    'path' => '/api/teachers/{id}',    'handler' => [ApiTeacherController::class, 'update']],
    ['method' => 'DELETE', 'path' => '/api/teachers/{id}',    'handler' => [ApiTeacherController::class, 'destroy']],

    // API Students
    ['method' => 'GET',    'path' => '/api/students',         'handler' => [ApiStudentController::class, 'index']],
    ['method' => 'GET',    'path' => '/api/students/{id}',    'handler' => [ApiStudentController::class, 'show']],
    ['method' => 'POST',   'path' => '/api/students',         'handler' => [ApiStudentController::class, 'store']],
    ['method' => 'PUT',    'path' => '/api/students/{id}',    'handler' => [ApiStudentController::class, 'update']],
    ['method' => 'DELETE', 'path' => '/api/students/{id}',    'handler' => [ApiStudentController::class, 'destroy']],

    // API Subjects
    ['method' => 'GET',    'path' => '/api/subjects',                     'handler' => [ApiSubjectController::class, 'index']],
    ['method' => 'GET',    'path' => '/api/subjects/{id}',                'handler' => [ApiSubjectController::class, 'show']],
    ['method' => 'POST',   'path' => '/api/subjects',                     'handler' => [ApiSubjectController::class, 'store']],
    ['method' => 'PUT',    'path' => '/api/subjects/{id}',                'handler' => [ApiSubjectController::class, 'update']],
    ['method' => 'DELETE', 'path' => '/api/subjects/{id}',                'handler' => [ApiSubjectController::class, 'destroy']],
    ['method' => 'POST',   'path' => '/api/subjects/{id}/assign-teacher', 'handler' => [ApiSubjectController::class, 'assignTeacher']],

    // API Courses
    ['method' => 'GET',    'path' => '/api/courses',      'handler' => [ApiCourseController::class, 'index']],
    ['method' => 'GET',    'path' => '/api/courses/{id}', 'handler' => [ApiCourseController::class, 'show']],
    ['method' => 'POST',   'path' => '/api/courses',      'handler' => [ApiCourseController::class, 'store']],
    ['method' => 'PUT',    'path' => '/api/courses/{id}', 'handler' => [ApiCourseController::class, 'update']],
    ['method' => 'DELETE', 'path' => '/api/courses/{id}', 'handler' => [ApiCourseController::class, 'destroy']],
];
