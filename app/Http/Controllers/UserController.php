<?php

namespace App\Http\Controllers;

use App\Models\Crew;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $crews = Crew::orderBy('created_at', 'desc')->simplePaginate(10);
        $rowcount = Crew::count();
        return view('index', compact('crews', 'rowcount'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->intended('/');
    }
}
