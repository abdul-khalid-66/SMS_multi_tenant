<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        return view('app.admin.students');
    }
}
