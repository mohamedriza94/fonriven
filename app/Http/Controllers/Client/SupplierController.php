<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Client;

class SupplierController extends Controller
{
    public function getSupplier()
    {
        $clients = Client::where('status','=','active')
        ->where('role','=','supplier')
        ->orderBy('id', 'DESC')
        ->get();
        return response()->json([
            'clients'=>$clients,
        ]);
    }

    public function getTrendingSuppliers()
    {
        $clients = Client::join('ratings','ratings.supplier_id','=','clients.id')
        ->where('clients.status','=','active')
        ->where('clients.role','=','supplier')
        ->where('ratings.average','>',3)
        ->orderBy('clients.id', 'DESC')->get();

        return response()->json([
            'clients'=>$clients,
        ]);
    }

    public function categorizeSupplier($category)
    {
        $clients = Client::join('products','products.supplier', '=', 'clients.id')
        ->where('products.category','=',$category)->orderBy('clients.id','DESC')
        ->get([
            'clients.photo AS photo',
            'clients.name AS name',
            'clients.joined AS joined',
            'clients.id AS id'
        ]);
        
        return response()->json([
            'clients' => $clients
        ]);
    }
    
    public function getOneSupplier($id)
    {
        $clients = Client::where('id','=',$id)->first();
        return response()->json([
            'clients'=>$clients,
        ]);
    }
}
