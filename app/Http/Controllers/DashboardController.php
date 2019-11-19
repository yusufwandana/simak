<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
}
