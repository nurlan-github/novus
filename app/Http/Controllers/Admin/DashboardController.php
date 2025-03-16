<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:show_dashboard')->only(['index']);
    }

    public function index()
    {
        return view('dashboard.index');
    }

    public function dismissWelcomeAlert(Request $request)
    {
        session(['welcome_alert_dismissed' => true]);
        return response()->json(['status' => 'success']);
    }
}