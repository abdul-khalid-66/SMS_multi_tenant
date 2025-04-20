<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the subjects.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get subjects with their classes and teachers
        $subjects = Subject::with(['class', 'teachers'])
            ->where('school_id', auth()->user()->school_id)
            ->orderBy('name')
            ->get();

        return view('app.admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new subject.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classes::where('school_id', auth()->user()->school_id)
            ->orderBy('numeric_value')
            ->get();

        return view('app.admin.subjects.create', compact('classes'));
    }

    /**
     * Store a newly created subject in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10',
            'class_id' => 'nullable|exists:classes,id'
        ]);

        $validated['school_id'] = auth()->user()->school_id;

        Subject::create($validated);

        return redirect()->route('dashboard.academic.subjects.index')
            ->with('success', 'Subject created successfully');
    }

    /**
     * Show the form for editing the specified subject.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::where('school_id', auth()->user()->school_id)
            ->findOrFail($id);

        $classes = Classes::where('school_id', auth()->user()->school_id)
            ->orderBy('numeric_value')
            ->get();

        return view('app.admin.classes.edit', compact('subject', 'classes'));
    }

    /**
     * Update the specified subject in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subject = Subject::where('school_id', auth()->user()->school_id)
            ->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10',
            'class_id' => 'nullable|exists:classes,id'
        ]);

        $subject->update($validated);

        return redirect()->route('dashboard.academic.subjects.index')
            ->with('success', 'Subject updated successfully');
    }

    /**
     * Remove the specified subject from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::where('school_id', auth()->user()->school_id)
            ->findOrFail($id);

        // Check if subject has teachers assigned before deleting
        if ($subject->teachers()->count() > 0) {
            return back()->with('error', 'Cannot delete subject with assigned teachers');
        }

        $subject->delete();

        return redirect()->route('dashboard.academic.subjects.index')
            ->with('success', 'Subject deleted successfully');
    }

    /**
     * Show the form for assigning teachers to subjects.
     *
     * @return \Illuminate\Http\Response
     */
    public function assign()
    {
        $subjects = Subject::where('school_id', auth()->user()->school_id)
            ->orderBy('name')
            ->get();

        $classes = Classes::where('school_id', auth()->user()->school_id)
            ->orderBy('numeric_value')
            ->get();

        $teachers = User::where('school_id', auth()->user()->school_id)
            ->where('role', 'teacher')
            ->orderBy('name')
            ->get();

        // Get current assignments
        $assignments = [];
        foreach ($subjects as $subject) {
            foreach ($classes as $class) {
                $teacher = $subject->teachers()
                    ->wherePivot('class_id', $class->id)
                    ->first();

                $assignments[$subject->id][$class->id] = [
                    'teacher_id' => $teacher ? $teacher->id : null,
                    'is_class_teacher' => $teacher ? $teacher->pivot->is_class_teacher : false
                ];
            }
        }

        return view('app.admin.classes.assign', compact('subjects', 'classes', 'teachers', 'assignments'));
    }

    /**
     * Update teacher assignments for subjects.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAssignments(Request $request)
    {
        $validated = $request->validate([
            'assignments' => 'required|array',
            'assignments.*.*.teacher_id' => 'nullable|exists:users,id',
            'assignments.*.*.is_class_teacher' => 'nullable|boolean'
        ]);

        // Clear all existing assignments
        \DB::table('teacher_subjects')
            ->where('school_id', auth()->user()->school_id)
            ->delete();

        // Add new assignments
        foreach ($validated['assignments'] as $subjectId => $classAssignments) {
            foreach ($classAssignments as $classId => $assignment) {
                if (!empty($assignment['teacher_id'])) {
                    \DB::table('teacher_subjects')->insert([
                        'teacher_id' => $assignment['teacher_id'],
                        'subject_id' => $subjectId,
                        'class_id' => $classId,
                        'is_class_teacher' => $assignment['is_class_teacher'] ?? false,
                        'school_id' => auth()->user()->school_id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        return redirect()->route('dashboard.academic.subjects.index')
            ->with('success', 'Teacher assignments updated successfully');
    }
}
