<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class UserController extends Controller
{
    //get list of users (buyers and suppliers)
    public function getUsers($limit, $type)
    {
        
        if($type == 'all')
        {
            //get all users
        $clients = Client::orderBy('id', 'DESC')->limit(6)->offSet($limit)->get();
        return response()->json([
            'users'=>$clients,
        ]);
        }
        else
        {
            //filter by role
            $clients = Client::where('role','=',$type)->orderBy('id', 'DESC')->limit(6)->offSet($limit)->get();
            return response()->json([
                'users'=>$clients,
            ]);
        }
    }

    public function searchUsers($search)
    {
        $clients = Client::where('name','Like','%'.$search.'%')->orWhere('telephone','Like','%'.$search.'%')
        ->orderBy('id', 'DESC')->get();
        return response()->json([
            'users'=>$clients,
        ]);
    }

    //change user status as active or inactive
    public function changeStatus(Request $request)
    {
            $clients = Client::where('id','=',$request->input('no'))->first();
            $clients->status = $request->input('status');
            $clients->save();

            return response()->json([
                'status'=>200
            ]);
    }

    ///get details of a single user
    public function getOneSupplier($id)
    {
        $clients = Client::where('id','=',$id)->first();
        return response()->json([
            'clients'=>$clients,
        ]);
    }
}
