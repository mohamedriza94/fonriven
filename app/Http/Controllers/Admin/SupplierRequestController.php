<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupplierRequest;
use App\Models\Client;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class SupplierRequestController extends Controller
{
    public function getRequests($limit)
    {
        $requests = SupplierRequest::orderBy('id', 'DESC')->limit(6)->offSet($limit)->get();
        return response()->json([
            'requests'=>$requests,
        ]);
    }
    
    public function viewRequest($id)
    {
        $request = SupplierRequest::where('id','=',$id)->first();
        return response()->json([
            'requests'=>$request,
        ]);
    }
    
    public function takeActionToRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'photo' => ['required'],
            'name' => ['required'],
            'telephone' => ['required','digits_between:9,10'],
            'email' => ['required','email',],
            'status' => ['required'],
        ]); //validate all the data
        
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            //update supplier request status first
            $status = $request->input('status');
            
            $SupplierRequests = SupplierRequest::find($request->input('id'));
            $SupplierRequests->status = $status;
            $SupplierRequests->save();
            
            //save supplier data
            $password  = rand(199999,999999);
            
            $clients = new Client;
            $clients->name = $request->input('name');
            $clients->telephone = $request->input('telephone');
            $clients->email = $request->input('email');
            $clients->photo = $request->input('photo');
            $clients->role = 'supplier';
            $clients->joined = NOW();
            $clients->status = 'active';
            $clients->password = Hash::make($password);
            $clients->save();
            
            if($status == "accepted")
            {
                //Mailing Credentials
                $data["email"] = $request->input('email');
                $data["title"] = "Fonriven Client Credentials";
                $data["password"] = $password;
                
                Mail::send('mail.clientCredentialsMail', $data, function($message)use($data) {
                    $message->to($data["email"], $data["email"])
                    ->subject($data["title"]);
                });
                
                return response()->json([
                    'status'=>200,
                ]);
            }
            else
            {   
                //Mailing Declination Letter
                $data["email"] = $request->input('email');
                $data["title"] = "Declination Letter";
                $data["name"] = $request->input('name');
                
                Mail::send('mail.declinationLetterMail', $data, function($message)use($data) {
                    $message->to($data["email"], $data["email"])
                    ->subject($data["title"]);
                });
                
                return response()->json([
                    'status'=>200,
                ]);
            }
        }
    }
}
