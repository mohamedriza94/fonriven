<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Client;

class SupplierController extends Controller
{
    public function getSupplier()
    {
        $clients = Client::where('status','=','active')->where('role','=','supplier')->orderBy('id', 'DESC')->get();
        return response()->json([
            'clients'=>$clients,
        ]);
    }

    public function searchSupplier($search)
    {
    }
    
    public function getOneSupplier($id)
    {
        $clients = Client::where('id','=',$id)->first();
        return response()->json([
            'clients'=>$clients,
        ]);
    }
}
