<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubjectController extends Controller
{
    public function __construct(private ApiService $api) {}

    public function index(): View
    {
        $subjects = $this->api->getSubjects();
        return view('subjects.index', compact('subjects'));
    }

    public function create(): View
    {
        return view('subjects.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id'   => 'required|string|max:36',
            'name' => 'required|string|max:255',
        ]);

        $result = $this->api->createSubject($validated);

        if (empty($result)) {
            return back()->with('error', 'Could not create subject. Check the API is running.')->withInput();
        }

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }

    public function show(string $id): View
    {
        $subject = $this->api->getSubject($id);

        if (! $subject) {
            abort(404, 'Subject not found.');
        }

        return view('subjects.show', compact('subject'));
    }

    public function edit(string $id): View
    {
        $subject  = $this->api->getSubject($id);
        $teachers = $this->api->getTeachers();

        if (! $subject) {
            abort(404, 'Subject not found.');
        }

        return view('subjects.edit', compact('subject', 'teachers'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->api->updateSubject($id, $validated);

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $this->api->deleteSubject($id);
        return redirect()->route('subjects.index')->with('success', 'Subject deleted.');
    }

    public function assignTeacher(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'teacher_id' => 'required|string',
        ]);

        $this->api->assignTeacherToSubject($id, $validated['teacher_id']);

        return redirect()->route('subjects.index')->with('success', 'Teacher assigned to subject.');
    }
}
