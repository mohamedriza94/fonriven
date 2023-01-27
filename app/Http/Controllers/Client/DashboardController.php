<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('client.dashboard.index');
    }
    
    public function connections(Request $request)
    {
        return view('client.dashboard.connections');
    }
    
    public function products(Request $request)
    {
        return view('client.dashboard.products');
    }
    
    public function messages(Request $request)
    {
        return view('client.dashboard.messages');
    }
}
