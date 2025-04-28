<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\School;
use App\Models\Subject;
use App\Models\SystemSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolProfileController extends Controller
{
    /**
     * Display a listing of the classes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school = School::first();
        $stats = [
            'students' => User::role('student')->count(),
            'teachers' => User::role('teacher')->count(),
            'classes' => Classes::count(),
        ];

        $classes = Classes::with(['sections', 'classTeacher'])
            ->orderBy('numeric_value')
            ->get();

        $subjects = Subject::with(['teacherSubjects.class', 'teacherSubjects.teacher'])
            ->orderBy('name')
            ->get();


        return view('app.admin.schoo_profile.school_profile', compact('school', 'stats', 'classes', 'subjects'));
    }

    // SchoolController.php

    public function edit(School $school)
    {
        $school = School::first();
        return view('app.admin.schoo_profile.edit_profile', compact('school'));
    }

    public function update(Request $request, School $school)
    {
        $school = School::first();
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'session_year'  => 'required|string|max:20',
            'address'       => 'required|string',
            'phone'         => 'required|string|max:20',
            'email'         => 'required|email|unique:schools,email,' . $school->id,
            'logo'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website'       => 'nullable|url',
            'type'          => 'nullable|string',
            'affiliation'   => 'nullable|string',
            'principal'     => 'nullable|string',
            'about'         => 'nullable|string',
            'established_year'       => 'nullable|integer|min:1900|max:' . date('Y'),
            'working_hours'          => 'nullable|string',
            'social_links'           => 'nullable|array',
            'social_links.facebook'  => 'nullable|url',
            'social_links.twitter'   => 'nullable|url',
            'social_links.instagram' => 'nullable|url',
            'social_links.youtube'   => 'nullable|url',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if it exists
            if ($school->logo && Storage::disk('website')->exists($school->logo)) {
                Storage::disk('website')->delete($school->logo);
            }

            // Store new logo
            $logoPath = $request->file('logo')
                ->store("tenants/" . tenant('id') . "/school/profile", 'website');

            $validated['logo'] = $logoPath;
        }

        // Process social links - filter out empty values and convert to JSON
        if (isset($validated['social_links'])) {
            $validated['social_links'] = json_encode(
                array_filter($validated['social_links'], function ($value) {
                    return !empty($value);
                })
            );
        } else {
            $validated['social_links'] = null;
        }

        // Update the school record
        $school->update($validated);

        return redirect()->route('schools.show')
            ->with('success', 'School profile updated successfully');
    }

    public function showSettings(School $school)
    {
        $school = School::first();
        $settings = SystemSetting::where('school_id', $school->id)
            ->pluck('setting_value', 'setting_key')
            ->toArray();

        return view('app.admin.schoo_profile.settings', compact('school', 'settings'));
    }

    public function updateSettings(Request $request, School $school)
    {
        $school = School::first();
        $settings = $request->except(['_token', '_method']);

        foreach ($settings as $key => $value) {
            SystemSetting::updateOrCreate(
                ['school_id' => $school->id, 'setting_key' => $key],
                ['setting_value' => $value]
            );
        }

        return back()->with('success', 'Settings updated successfully');
    }

    // app/Http/Controllers/SchoolController.php

    public function updateAcademicSettings(Request $request, School $school)
    {
        $school = School::first();
        $validated = $request->validate([
            'working_hours_start'    => 'required|date_format:H:i',
            'working_hours_end'      => 'required|date_format:H:i|after:working_hours_start',
            'working_days_start'     => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'working_days_end'       => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'grading_system'         => 'required|in:percentage,letter,gpa',
            'default_class_capacity' => 'required|integer|min:10|max:60',
            'auto_promotion'         => 'nullable',
        ]);

        // Convert checkbox value to boolean
        $validated['auto_promotion'] = $request->has('auto_promotion');

        foreach ($validated as $key => $value) {
            SystemSetting::updateOrCreate(
                ['school_id' => $school->id, 'setting_key' => $key],
                ['setting_value' => $value]
            );
        }

        return back()->with('success', 'Academic settings updated successfully');
    }

    public function updateAttendanceSettings(Request $request, School $school)
    {
        $school = School::first();
        $validated = $request->validate([
            'attendance_method'             => 'required|in:daily,session',
            'late_threshold'                => 'required|integer|min:1|max:60',
            'send_absence_notifications'    => 'nullable',
            'absence_notification_method'   => 'required|in:email,sms,both',
        ]);

        foreach ($validated as $key => $value) {
            SystemSetting::updateOrCreate(
                ['school_id' => $school->id, 'setting_key' => $key],
                ['setting_value' => $value]
            );
        }

        return back()->with('success', 'Attendance settings updated successfully');
    }
}
