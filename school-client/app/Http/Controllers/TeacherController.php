<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function __construct(private ApiService $api) {}

    public function index()
    {
        $teachers = $this->api->getTeachers();
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id'    => 'required|string|max:36',
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $result = $this->api->createTeacher($validated);

        if (empty($result)) {
            return back()->with('error', 'Could not create teacher. Check the API is running.')->withInput();
        }

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }

    public function show(string $id)
    {
        $teacher = $this->api->getTeacher($id);

        if (! $teacher) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Teacher not found.');
        }

        return view('teachers.show', compact('teacher'));
    }

    public function edit(string $id)
    {
        $teacher = $this->api->getTeacher($id);

        if (! $teacher) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Teacher not found.');
        }

        return view('teachers.edit', compact('teacher'));
    }
    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $this->api->updateTeacher($id, $validated);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $this->api->deleteTeacher($id);
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted.');
    }
}
