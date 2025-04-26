<?php

namespace App\Http\Controllers\Timetable;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Subject;
use App\Models\TimeTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimetableController extends Controller
{

    public function index()
    {
        // Static timetable data
        // Static timetable data for multiple classes
        // $staticTimetables = [
        //     [
        //         'class_id' => 3, // Class 1
        //         'section_id' => 1, // Section A
        //         'class_name' => 'Class 1 (Section A)',
        //         'periods' => [
        //             'First Period' => [
        //                 'Monday' => [
        //                     'teacher' => 'Michael Brown',
        //                     'subject' => 'Mathematics',
        //                     'start' => '09:00 AM',
        //                     'end' => '10:00 AM',
        //                     'room' => 'Room 101'
        //                 ],
        //                 'Tuesday' => [
        //                     'teacher' => 'Emily Davis',
        //                     'subject' => 'English',
        //                     'start' => '09:00 AM',
        //                     'end' => '10:00 AM',
        //                     'room' => 'Room 102'
        //                 ],
        //                 'Wednesday' => [
        //                     'teacher' => 'Robert Wilson',
        //                     'subject' => 'Science',
        //                     'start' => '09:00 AM',
        //                     'end' => '10:00 AM',
        //                     'room' => 'Lab 1'
        //                 ],
        //                 'Thursday' => [
        //                     'teacher' => 'Jennifer Lee',
        //                     'subject' => 'Social Studies',
        //                     'start' => '09:00 AM',
        //                     'end' => '10:00 AM',
        //                     'room' => 'Room 103'
        //                 ],
        //                 'Friday' => [
        //                     'teacher' => 'Sarah Johnson',
        //                     'subject' => 'Computer Science',
        //                     'start' => '09:00 AM',
        //                     'end' => '10:00 AM',
        //                     'room' => 'Computer Lab'
        //                 ]
        //             ],
        //             'Second Period' => [
        //                 'Monday' => [
        //                     'event' => 'Full Break',
        //                     'start' => '12:00 PM',
        //                     'end' => '01:00 PM',
        //                     'room' => 'Cafeteria'
        //                 ],
        //                 'Tuesday' => [
        //                     'event' => 'Half Break',
        //                     'start' => '01:30 PM',
        //                     'end' => '02:00 PM',
        //                     'room' => 'Cafeteria'
        //                 ],
        //                 'Wednesday' => [
        //                     'teacher' => 'Michael Brown',
        //                     'subject' => 'Mathematics',
        //                     'start' => '10:30 AM',
        //                     'end' => '11:30 AM',
        //                     'room' => 'Room 101'
        //                 ],
        //                 'Thursday' => [
        //                     'teacher' => 'Emily Davis',
        //                     'subject' => 'English',
        //                     'start' => '10:30 AM',
        //                     'end' => '11:30 AM',
        //                     'room' => 'Room 102'
        //                 ],
        //                 'Friday' => [
        //                     'teacher' => 'Robert Wilson',
        //                     'subject' => 'Science',
        //                     'start' => '10:30 AM',
        //                     'end' => '11:30 AM',
        //                     'room' => 'Lab 1'
        //                 ]
        //             ]
        //         ]
        //     ],
        //     [
        //         'class_id' => 4, // Class 2
        //         'section_id' => 3, // Section B
        //         'class_name' => 'Class 2 (Section B)',
        //         'periods' => [
        //             'First Period' => [
        //                 'Monday' => [
        //                     'teacher' => 'Emily Davis',
        //                     'subject' => 'English',
        //                     'start' => '09:00 AM',
        //                     'end' => '10:00 AM',
        //                     'room' => 'Room 102'
        //                 ],
        //                 'Tuesday' => [
        //                     'teacher' => 'Michael Brown',
        //                     'subject' => 'Mathematics',
        //                     'start' => '09:00 AM',
        //                     'end' => '10:00 AM',
        //                     'room' => 'Room 101'
        //                 ],
        //                 'Wednesday' => [
        //                     'teacher' => 'Jennifer Lee',
        //                     'subject' => 'Social Studies',
        //                     'start' => '09:00 AM',
        //                     'end' => '10:00 AM',
        //                     'room' => 'Room 103'
        //                 ],
        //                 'Thursday' => [
        //                     'teacher' => 'Robert Wilson',
        //                     'subject' => 'Science',
        //                     'start' => '09:00 AM',
        //                     'end' => '10:00 AM',
        //                     'room' => 'Lab 1'
        //                 ],
        //                 'Friday' => [
        //                     'teacher' => 'Sarah Johnson',
        //                     'subject' => 'Computer Science',
        //                     'start' => '09:00 AM',
        //                     'end' => '10:00 AM',
        //                     'room' => 'Computer Lab'
        //                 ]
        //             ],
        //             'Second Period' => [
        //                 'Monday' => [
        //                     'event' => 'Full Break',
        //                     'start' => '12:00 PM',
        //                     'end' => '01:00 PM',
        //                     'room' => 'Cafeteria'
        //                 ],
        //                 'Tuesday' => [
        //                     'event' => 'Half Break',
        //                     'start' => '01:30 PM',
        //                     'end' => '02:00 PM',
        //                     'room' => 'Cafeteria'
        //                 ],
        //                 'Wednesday' => [
        //                     'teacher' => 'Emily Davis',
        //                     'subject' => 'English',
        //                     'start' => '10:30 AM',
        //                     'end' => '11:30 AM',
        //                     'room' => 'Room 102'
        //                 ],
        //                 'Thursday' => [
        //                     'teacher' => 'Michael Brown',
        //                     'subject' => 'Mathematics',
        //                     'start' => '10:30 AM',
        //                     'end' => '11:30 AM',
        //                     'room' => 'Room 101'
        //                 ],
        //                 'Friday' => [
        //                     'teacher' => 'Jennifer Lee',
        //                     'subject' => 'Social Studies',
        //                     'start' => '10:30 AM',
        //                     'end' => '11:30 AM',
        //                     'room' => 'Room 103'
        //                 ]
        //             ]
        //         ]
        //     ]
        // ];

        $timetables = [];

        // Get all classes with their sections for the current school
        $classes = Classes::with('sections')
            ->where('school_id', auth()->user()->school_id)
            ->get();

        foreach ($classes as $class) {
            foreach ($class->sections as $section) {
                $timetableEntries = TimeTable::with(['subject', 'teacher'])
                    ->where('class_id', $class->id)
                    ->where('section_id', $section->id)
                    ->where('school_id', auth()->user()->school_id ?? 1)
                    ->orderBy('day_of_week')
                    ->orderBy('start_time')
                    ->get();

                $periods = [];
                foreach ($timetableEntries as $entry) {
                    $day = $entry->day_of_week;
                    $periodName = $entry->period_name;

                    if (!isset($periods[$periodName])) {
                        $periods[$periodName] = [];
                    }

                    if ($entry->is_break) {
                        $periods[$periodName][$day] = [
                            'event' => $entry->break_name,
                            'start' => \Carbon\Carbon::parse($entry->start_time)->format('h:i A'),
                            'end' => \Carbon\Carbon::parse($entry->end_time)->format('h:i A'),
                            'room' => $entry->room_number
                        ];
                    } else {
                        $periods[$periodName][$day] = [
                            'teacher' => $entry->teacher->name ?? 'N/A',
                            'subject' => $entry->subject->name ?? 'N/A',
                            'start' => \Carbon\Carbon::parse($entry->start_time)->format('h:i A'),
                            'end' => \Carbon\Carbon::parse($entry->end_time)->format('h:i A'),

                            'room' => $entry->room_number
                        ];
                    }
                }

                $timetables[] = [
                    'class_id' => $class->id,
                    'section_id' => $section->id,
                    'class_name' => $class->name . ' (Section ' . $section->name . ')',
                    'periods' => $periods
                ];
            }
        }


        return view('app.timetable.index', compact('timetables'));
    }


    public function create()
    {
        $classes = Classes::where('school_id', auth()->user()->school_id)->get();
        $sections = Section::where('school_id', auth()->user()->school_id)->get();
        $subjects = Subject::where('school_id', auth()->user()->school_id)->get();
        $teachers = User::role('teacher')->get();

        return view('app.timetable.create', compact('classes', 'sections', 'subjects', 'teachers'));
    }

    // public function store(Request $request)
    // {

    //     $validated = $request->validate([
    //         'class_id' => 'required|exists:classes,id',
    //         'section_id' => 'required|exists:sections,id',
    //         'periods' => 'required|array',
    //         'periods.*.day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
    //         'periods.*.start_time' => 'required|date_format:H:i',
    //         'periods.*.end_time' => 'required|date_format:H:i|after:periods.*.start_time',
    //         'periods.*.subject_id' => 'nullable|exists:subjects,id',
    //         'periods.*.teacher_id' => 'nullable|exists:users,id',
    //         'periods.*.room_number' => 'nullable|string|max:20',
    //         'periods.*.is_break' => 'sometimes|boolean',
    //         'periods.*.break_name' => 'nullable|string|max:50',
    //     ]);
    //     // dd($request->all());
    //     // try {
    //     // Delete existing timetable for this class/section
    //     TimeTable::where('class_id', $validated['class_id'])
    //         ->where('section_id', $validated['section_id'])
    //         ->delete();

    //     // Create new timetable entries
    //     foreach ($validated['periods'] as $period) {
    //         dd($period);
    //         TimeTable::create([
    //             'school_id' => auth()->user()->school_id,
    //             'class_id' => $validated['class_id'],
    //             'section_id' => $validated['section_id'],
    //             'subject_id' => $period['is_break'] ?? false ? null : $period['subject_id'],
    //             'teacher_id' => $period['is_break'] ?? false ? null : $period['teacher_id'],
    //             'day_of_week' => $period['day'],
    //             'period_name' => isset($period['period_name']) && $period['period_name'] !== null
    //                 ? $period['period_name']
    //                 : 'Period',
    //             'start_time' => $period['start_time'],
    //             'end_time' => $period['end_time'],
    //             'room_number' => $period['room_number'],
    //             'is_break' => $period['is_break'] ?? false,
    //             'break_name' => $period['break_name'] ?? null,
    //             'is_recurring' => true,
    //         ]);
    //     }

    //     return redirect()->route('admin.timetable.index')->with('success', 'Timetable created successfully!');
    //     // } catch (\Exception $e) {
    //     //     return back()->with('error', 'Error creating timetable: ' . $e->getMessage());
    //     // }
    // }


    public function store(Request $request)
    {
        // dd($request->all());
        // $validated = $request->validate([
        //     'class_id' => 'required|exists:classes,id',
        //     'section_id' => 'required|exists:sections,id',
        //     'periods' => 'required|array|min:1',
        //     'periods.*.day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
        //     'periods.*.period_name' => 'required|string|max:50',
        //     'periods.*.start_time' => 'required|date_format:H:i',
        //     'periods.*.end_time' => 'required|date_format:H:i|after:periods.*.start_time',
        //     'periods.*.subject_id' => 'nullable|required_unless:periods.*.is_break,true|exists:subjects,id',
        //     'periods.*.teacher_id' => 'nullable|required_unless:periods.*.is_break,true|exists:users,id',
        //     'periods.*.room_number' => 'nullable|string|max:20',
        //     'periods.*.is_break' => 'sometimes',
        //     'periods.*.break_name' => 'nullable|required_if:periods.*.is_break,true|string|max:50',
        // ]);
        $validated = $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'periods' => 'required',
            'periods.*.day' => 'required',
            'periods.*.period_name' => 'required',
            'periods.*.start_time' => 'required',
            'periods.*.end_time' => 'required',
            'periods.*.subject_id' => 'nullable',
            'periods.*.teacher_id' => 'nullable',
            'periods.*.room_number' => 'nullable',
            'periods.*.is_break' => 'sometimes',
            'periods.*.break_name' => 'nullable',
        ]);

        // dd($request->all());
        // try {
        DB::beginTransaction();

        // Delete existing timetable first
        TimeTable::where('class_id', $validated['class_id'])
            ->where('section_id', $validated['section_id'])
            ->delete();

        // Track existing time slots to prevent overlaps
        $timeSlots = [];

        foreach ($validated['periods'] as $index => $period) {
            // Validate period name exists
            if (!isset($period['period_name'])) {
                throw new \Exception("Period name is missing for period {$index}");
            }

            // Check for time slot conflicts
            $timeSlotKey = "{$validated['class_id']}-{$validated['section_id']}-{$period['day']}-{$period['start_time']}";

            if (isset($timeSlots[$timeSlotKey])) {
                throw new \Exception("Duplicate time slot detected for {$period['day']} at {$period['start_time']}");
            }

            $timeSlots[$timeSlotKey] = true;

            // Prepare data
            $isBreak = isset($period['is_break']) ? 1 : 0;
            $timeTableData = [
                'school_id' => auth()->user()->school_id ?? 1,
                'class_id' => $validated['class_id'],
                'section_id' => $validated['section_id'],
                'day_of_week' => $period['day'],
                'period_name' => $period['period_name'],
                'start_time' => $period['start_time'],
                'end_time' => $period['end_time'],
                'room_number' => $period['room_number'] ?? null,
                'is_recurring' => true,
                'is_break' => $isBreak,
                'break_name' => $isBreak ? ($period['break_name'] ?? null) : null,
                'subject_id' => $isBreak ? null : ($period['subject_id'] ?? null),
                'teacher_id' => $isBreak ? null : ($period['teacher_id'] ?? null),
            ];

            \Log::debug("Creating timetable entry:", $timeTableData);

            // Create the entry
            TimeTable::create($timeTableData);
        }

        DB::commit();
        return redirect()->route('admin.timetable.index')->with('success', 'Timetable created successfully!');
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     \Log::error('Timetable creation failed: ' . $e->getMessage());
        //     return back()->withInput()
        //         ->with('error', 'Error creating timetable: ' . $e->getMessage());
        // }
    }


    public function edit($id) {}


    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
