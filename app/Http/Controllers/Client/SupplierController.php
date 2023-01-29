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
    //get list of active suppliers 
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

    //get list of trending suppliers
    public function getTrendingSuppliers()
    {
        $clients = Client::where('status','=','active')
        ->where('role','=','supplier')
        ->orderBy('id', 'desc')
        ->get();

        return response()->json([
            'clients'=>$clients,
        ]);
    }

    //sort supplier by category of products they have
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
    
    //get details of a single supplier
    public function getOneSupplier($id)
    {
        $clients = Client::where('id','=',$id)->first();
        return response()->json([
            'clients'=>$clients,
        ]);
    }
}
