<?php

use App\Controllers\HomeController;
use App\Controllers\Student\StudentController;
use App\Controllers\Teacher\TeacherController;
use App\Controllers\Subject\SubjectController;
use App\Controllers\Course\CourseController;
use App\Controllers\Enrollment\EnrollmentController;
use App\Controllers\Api\ApiTeacherController;
use App\Controllers\Api\ApiStudentController;
use App\Controllers\Api\ApiSubjectController;
use App\Controllers\Api\ApiCourseController;

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
