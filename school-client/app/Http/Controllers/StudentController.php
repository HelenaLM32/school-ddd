<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(private ApiService $api) {}

    public function index()
    {
        $students = $this->api->getStudents();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id'    => 'required|string|max:36',
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $result = $this->api->createStudent($validated);

        if (empty($result)) {
            return back()->with('error', 'Could not create student. Check the API is running.')->withInput();
        }

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function show(string $id)
    {
        $student = $this->api->getStudent($id);

        if (! $student) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Student not found.');
        }

        return view('students.show', compact('student'));
    }

    public function edit(string $id)
    {
        $student = $this->api->getStudent($id);

        if (! $student) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Student not found.');
        }

        return view('students.edit', compact('student'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $this->api->updateStudent($id, $validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $this->api->deleteStudent($id);
        return redirect()->route('students.index')->with('success', 'Student deleted.');
    }
}
