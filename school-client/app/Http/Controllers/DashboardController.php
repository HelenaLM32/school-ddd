<?php

namespace App\Http\Controllers;

use App\Services\ApiService;

class DashboardController extends Controller
{
    public function __construct(private ApiService $api) {}

    public function index()
    {
        $teachers = $this->api->getTeachers();
        $students = $this->api->getStudents();
        $subjects = $this->api->getSubjects();

        return view('dashboard', compact('teachers', 'students', 'subjects'));
    }
}
