<?php

use App\Controllers\HomeController;
use App\Controllers\Student\StudentController;
use App\Controllers\Teacher\TeacherController;
use App\Controllers\Subject\SubjectController;
use App\Controllers\Course\CourseController;
use App\Controllers\Enrollment\EnrollmentController;

return [
    // Home
    ['method' => 'GET',  'path' => '/',          'handler' => [HomeController::class, 'index']],

    // Students
    ['method' => 'GET',  'path' => '/student',            'handler' => [HomeController::class, 'student']],
    ['method' => 'GET',  'path' => '/student/create',     'handler' => [StudentController::class, 'create']],
    ['method' => 'POST', 'path' => '/student/store',      'handler' => [StudentController::class, 'store']],

    // Teachers
    ['method' => 'GET',  'path' => '/teacher',            'handler' => [HomeController::class, 'teacher']],
    ['method' => 'GET',  'path' => '/teacher/create',     'handler' => [TeacherController::class, 'create']],
    ['method' => 'POST', 'path' => '/teacher/store',      'handler' => [TeacherController::class, 'store']],

    // Subjects
    ['method' => 'GET',  'path' => '/subject',            'handler' => [HomeController::class, 'subject']],
    ['method' => 'GET',  'path' => '/subject/create',     'handler' => [SubjectController::class, 'create']],
    ['method' => 'POST', 'path' => '/subject/store',      'handler' => [SubjectController::class, 'store']],
    ['method' => 'GET',  'path' => '/subject/assign-teacher',      'handler' => [SubjectController::class, 'assignTeacher']],
    ['method' => 'POST', 'path' => '/subject/assign-teacher/store','handler' => [SubjectController::class, 'storeAssignTeacher']],

    // Courses
    ['method' => 'GET',  'path' => '/course',             'handler' => [HomeController::class, 'course']],
    ['method' => 'GET',  'path' => '/course/create',      'handler' => [CourseController::class, 'create']],
    ['method' => 'POST', 'path' => '/course/store',       'handler' => [CourseController::class, 'store']],

    // Enrollment
    ['method' => 'GET',  'path' => '/enrollment',         'handler' => [HomeController::class, 'enrollment']],
    ['method' => 'GET',  'path' => '/enrollment/create',  'handler' => [EnrollmentController::class, 'create']],
    ['method' => 'POST', 'path' => '/enrollment/store',   'handler' => [EnrollmentController::class, 'store']],
];
