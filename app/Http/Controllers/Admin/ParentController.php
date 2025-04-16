<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ParentController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        return view('app.admin.parents');
    }

    public function create()
    {
        return view('app.admin.add_parent');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
