<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\Client;
use App\Models\Connection;
use App\Models\SupplierRequest;

class DashboardController extends Controller
{
    //functions to access web pages in admin dashboard
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

    public function inquiries(Request $request)
    {
        return view('admin.dashboard.inquiries');
    }

    //get counts of different entitites
    public function counts()
    {
        $inquiries = Inquiry::where('status','=','unread')->count();
        $users = Client::where('status','=','active')->count();
        $supplierRequests = supplierRequest::where('status','=','pending')->count();
        $suppliers = Client::where('status','=','active')->where('role','=','supplier')->count();
        $buyers = Client::where('status','=','active')->where('role','=','buyer')->count();
        $connections = Connection::where('status','=','active')->count();

        return response()->json([
            'inquiries'=>$inquiries,
            'users'=>$users,
            'supplierRequests'=>$supplierRequests,
            'suppliers'=>$suppliers,
            'buyers'=>$buyers,
            'connections'=>$connections
        ]);
    }
}
