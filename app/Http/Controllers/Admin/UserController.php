<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class UserController extends Controller
{
    public function getUsers($limit, $type)
    {
        if($type == 'all')
        {
        $clients = Client::orderBy('id', 'DESC')->limit(6)->offSet($limit)->get();
        return response()->json([
            'users'=>$clients,
        ]);
        }
        else
        {
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

    //change Product status
    public function changeStatus(Request $request)
    {
            $clients = Client::where('id','=',$request->input('no'))->first();
            $clients->status = $request->input('status');
            $clients->save();

            return response()->json([
                'status'=>200
            ]);
    }
}
