<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    /**
     * Display a listing of the classes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get classes with their class teacher and sections count
        $classes = Classes::with(['classTeacher', 'sections'])
            ->where('school_id', auth()->user()->school_id)
            ->orderBy('numeric_value')
            ->get();
        return view('app.admin.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new class.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get teachers for dropdown
        $teachers = User::where('school_id', auth()->user()->school_id)
            ->where('role', 'teacher')
            ->orderBy('name')
            ->get();

        return view('app.admin.classes.create', compact('teachers'));
    }

    /**
     * Store a newly created class in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'numeric_value' => 'required|integer|min:0',
            'teacher_id' => 'nullable|exists:users,id'
        ]);

        $validated['school_id'] = auth()->user()->school_id;

        Classes::create($validated);

        return redirect()->route('dashboard.academic.classes.index')
            ->with('success', 'Class created successfully');
    }

    /**
     * Show the form for editing the specified class.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class = Classes::where('school_id', auth()->user()->school_id)
            ->findOrFail($id);

        $teachers = User::where('school_id', auth()->user()->school_id)
            ->where('role', 'teacher')
            ->orderBy('name')
            ->get();

        return view('app.admin.classes.edit', compact('class', 'teachers'));
    }

    /**
     * Update the specified class in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $class = Classes::where('school_id', auth()->user()->school_id)
            ->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'numeric_value' => 'required|integer|min:0',
            'teacher_id' => 'nullable|exists:users,id'
        ]);

        $class->update($validated);

        return redirect()->route('dashboard.academic.classes.index')
            ->with('success', 'Class updated successfully');
    }

    /**
     * Remove the specified class from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = Classes::where('school_id', auth()->user()->school_id)
            ->findOrFail($id);

        // Check if class has sections before deleting
        if ($class->sections()->count() > 0) {
            return back()->with('error', 'Cannot delete class with sections');
        }

        $class->delete();

        return redirect()->route('dashboard.academic.classes.index')
            ->with('success', 'Class deleted successfully');
    }
}
