<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Subject;
use App\Models\TimeTable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\StudentProfile;
use App\Models\AttendanceSession;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AttendanceController extends Controller
{

    public function index()
    {
        return view('app.attendance.index');
    }


    public function create()
    {
        // if subject wise attendance the update data for system_setting 
        $classes = Classes::orderBy('numeric_value')->get();
        return view('app.attendance.take_attendance', compact('classes'));
    }

    /**
     * Get sections for a class (AJAX)
     */
    public function getSections(Request $request)
    {
        $classId = $request->input('class_id');

        $sections = Section::where('class_id', $classId)
            ->where('school_id', auth()->user()->school_id)
            ->orderBy('name')
            ->get();

        return response()->json([
            'sections' => $sections
        ]);
    }

    /**
     * Get subjects for a class (AJAX)
     */
    public function getSubjects(Request $request)
    {
        $classId = $request->input('class_id');

        $subjects = Subject::where('class_id', $classId)
            ->where('school_id', auth()->user()->school_id)
            ->orderBy('name')
            ->get();

        return response()->json([
            'subjects' => $subjects
        ]);
    }

    /**
     * Get students for attendance (AJAX)
     */
    public function getStudents(Request $request)
    {
        $request->validate([
            'class_id'      => 'required|exists:classes,id',
            'section_id'    => 'required|exists:sections,id',
            'date'          => 'required|date'
        ]);

        $classId    = $request->input('class_id');
        $sectionId  = $request->input('section_id');
        $date       = $request->input('date');
        $subjectId  = $request->input('subject_id');

        // Get class and section details
        $class = Classes::findOrFail($classId);
        $section = Section::findOrFail($sectionId);

        // Get students in this class/section
        $students = StudentProfile::with(['student'])
            ->where('class_id', $classId)
            ->where('section_id', $sectionId)
            // ->where('school_id', auth()->user()->school_id)
            ->orderBy('admission_no')
            ->get();

        // Get existing attendance for this date if any
        $existingAttendance = [];

        // Find timetable entry if this is subject-wise attendance
        $timetableId = null;
        if ($subjectId) {
            $dayOfWeek = strtolower(date('l', strtotime($date)));
            $timetable = TimeTable::where('class_id', $classId)
                ->where('section_id', $sectionId)
                ->where('subject_id', $subjectId)
                ->where('day_of_week', $dayOfWeek)
                ->where('school_id', auth()->user()->school_id)
                ->first();

            $timetableId = $timetable ? $timetable->id : null;
        }

        $session = AttendanceSession::where('time_table_id', $timetableId)
            ->whereDate('date', $date)
            ->first();

        if ($session) {
            $existingAttendance = $session->attendances()
                ->select('user_id', 'status', 'remarks')
                ->get()
                ->keyBy('user_id')
                ->toArray();
        }

        return response()->json([
            'class' => $class,
            'section' => $section,
            'students' => $students,
            'existingAttendance' => $existingAttendance
        ]);
    }


    /**
     * Store attendance data
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',
            'date' => 'required|date',
            'status' => 'required|in:draft,submitted',
            'attendance' => 'required|array'
        ]);

        DB::beginTransaction();

        try {
            $classId = $request->input('class_id');
            $sectionId = $request->input('section_id');
            $date = $request->input('date');
            $subjectId = $request->input('subject_id');
            $sessionType = $request->input('session_type');
            $status = $request->input('status');
            $attendanceData = $request->input('attendance');

            // Find timetable entry if this is subject-wise attendance
            $timetableId = null;
            
            $dayOfWeek = strtolower(date('l', strtotime($date)));
            $timetable = TimeTable::where('class_id', $classId)
                ->where('section_id', $sectionId)
                // ->where('subject_id', $subjectId)
                ->where('day_of_week', $dayOfWeek)
                // ->where('school_id', auth()->user()->school_id)
                ->first();

            $timetableId = $timetable ? $timetable->id : null;
            // }

            dd([$request->all(), $dayOfWeek,$timetableId]);
            // Create or update attendance session
            $session = AttendanceSession::updateOrCreate(
                [
                    // 'school_id' => auth()->user()->school_id,
                    'time_table_id' => $timetableId,
                    'date' => $date
                ],
                [
                    'recorded_by' => auth()->id(),
                    'notes' => $sessionType ? "Session Type: $sessionType" : null,
                    'status' => $status === 'submitted' ? 'submitted' : 'draft'
                ]
            );

            // Process each student's attendance
            foreach ($attendanceData as $studentAttendance) {
                if (empty($studentAttendance['status'])) {
                    continue;
                }

                Attendance::updateOrCreate(
                    [
                        'session_id' => $session->id,
                        'user_id' => $studentAttendance['student_id']
                    ],
                    [
                        'status' => $studentAttendance['status'],
                        'remarks' => $studentAttendance['remarks'] ?? null
                    ]
                );
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Attendance saved successfully!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to save attendance: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Helper method to find timetable ID for subject-wise attendance
     */
    private function getTimetableId($classId, $sectionId, $subjectId, $date)
    {
        $dayOfWeek = strtolower(date('l', strtotime($date)));

        $timetable = TimeTable::where('class_id', $classId)
            ->where('section_id', $sectionId)
            ->where('subject_id', $subjectId)
            ->where('day_of_week', $dayOfWeek)
            // ->where('school_id', auth()->user()->school_id)
            ->first();

        return $timetable ? $timetable->id : null;
    }

    public function checkClasses(Request $request){
        $date = $request->input('date');

        $dayOfWeek = strtolower(date('l', strtotime($date)));
    
        // Query your timetable to check for classes on this date
        $hasClasses = Timetable::where('day_of_week', $dayOfWeek)->exists();
        
        return response()->json([
            'has_classes' => $hasClasses,
            'date' => $date
        ]);
    }


    public function edit($id) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
