<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Subject;
use App\Models\TimeTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{

    public function index()
    {
        return view('app.attendance.index');        
    }

    public function create()
    {
      
    }

    public function store(Request $request)
    {
        
    }


    public function edit($id) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}

}
