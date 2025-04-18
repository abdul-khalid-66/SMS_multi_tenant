<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeacherProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TeacherController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        $teachers = User::with('teacherProfile')
            ->where('role', 'teacher')
            ->orWhere('role', 'admin') // Include admin-teachers if needed
            ->orderBy('name')
            ->get();

        return view('app.admin.teachers', compact('teachers'));
    }

    public function create()
    {
        return view('app.admin.add_teacher');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'phone'     => 'required|string|max:20',
            'address'   => 'required|string',
            'gender'    => 'required|in:male,female,other',
            'dob'       => 'required|date',
            'roles'     => 'required|array',
            'roles.*'   => 'in:admin,teacher',

            // Teacher profile fields
            'employee_id'       => 'required|string|max:50|unique:teacher_profiles,employee_id',
            'qualification'     => 'required|string|max:255',
            'specialization'    => 'required|string|max:255',
            'experience_years'  => 'required|integer|min:0',
            'joining_date'      => 'required|date',
            'salary_grade'      => 'required|string|max:50',
            'bank_details'      => 'nullable|string',
            'emergency_contact' => 'required|string|max:255',
            'bio'               => 'nullable|string',
            'social_links'      => 'nullable|string',
            'is_class_teacher'  => 'boolean',
            'class_teacher_of'  => 'nullable|exists:classes,id',

            // File uploads
            'qualification_documents' => 'nullable|file|max:5120',
            'signature'     => 'nullable|image|max:2048',
            'documents'     => 'nullable|array',
            'documents.*'   => 'file|max:5120',
        ]);

        try {
            DB::beginTransaction();

            // Create user account
            $user = User::create([
                'school_id' => auth()->user()->school_id,
                'name'      => $validated['name'],
                'email'     => $validated['email'],
                'phone'     => $validated['phone'],
                'address'   => $validated['address'],
                'gender'    => $validated['gender'],
                'dob'       => $validated['dob'],
                'password'  => bcrypt('12345678'), // Default password
                'role'      => in_array('admin', $validated['roles']) ? 'admin' : 'teacher',
            ]);

            // Assign roles
            foreach ($validated['roles'] as $role) {
                $user->assignRole($role);
            }

            // Handle file uploads
            $qualificationDocPath = null;
            if ($request->hasFile('qualification_documents')) {
                $qualificationDocPath = $request->file('qualification_documents')
                    ->store("tenants/{$user->school_id}/teachers/qualifications", 'website');
            }

            $signaturePath = null;
            if ($request->hasFile('signature')) {
                $signaturePath = $request->file('signature')
                    ->store("tenants/{$user->school_id}/teachers/signatures", 'website');
            }

            $documentPaths = [];
            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $document) {
                    $documentPaths[] = $document
                        ->store("tenants/{$user->school_id}/teachers/documents", 'website');
                }
            }

            // Create teacher profile
            TeacherProfile::create([
                'teacher_id'        => $user->id,
                'school_id'         => $user->school_id,
                'employee_id'       => $validated['employee_id'],
                'qualification'     => $validated['qualification'],
                'specialization'    => $validated['specialization'],
                'experience_years'  => $validated['experience_years'],
                'joining_date'      => $validated['joining_date'],
                'salary_grade'      => $validated['salary_grade'],
                'bank_details'      => $validated['bank_details'],
                'emergency_contact' => $validated['emergency_contact'],
                'documents'         => json_encode($documentPaths),
                'signature'         => $signaturePath,
                'bio'               => $validated['bio'],
                'social_links'      => $validated['social_links'],
                'is_class_teacher'  => $validated['is_class_teacher'] ?? false,
                'class_teacher_of'  => $validated['class_teacher_of'],
                'qualification_documents' => $qualificationDocPath,
            ]);


            // In future I might want to add additional features like:
            // Sending a welcome email with login credentials
            // Generating an ID card for the teacher
            // Setting up default permissions based on roles
            // Adding audit logging for the creation

            DB::commit();

            return redirect()->route('dashboard.teachers')
                ->with('success', 'Teacher created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error creating teacher: ' . $e->getMessage());
        }
    }
}
