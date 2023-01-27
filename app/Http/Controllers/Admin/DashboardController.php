<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.dashboard.index');
    }

    public function supplierRequest(Request $request)
    {
        return view('admin.dashboard.supplierRequest');
    }

    public function users(Request $request)
    {
        return view('admin.dashboard.users');
    }
}
