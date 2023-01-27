<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;
use App\Models\SupplierRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    //Create Buyer Account
    public function createBuyerAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'photo' => ['required','image'],
            'telephone' => ['required','unique:clients','digits_between:9,10'],
            'email' => ['required','unique:clients','email'],
            'role' => ['required'],
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
            $password  = rand(199999,999999);

            $clients = new Client;
            $clients->name = $request->input('name');
            $clients->telephone = $request->input('telephone');
            $clients->email = $request->input('email');
            $clients->role = $request->input('role');
            $clients->joined = NOW();
            $clients->status = 'active';
            $clients->password = Hash::make($password);
            
            If(request('photo')!="")
            {
                $photoPath = request('photo')->store('client','public'); //get image path
                $clients->photo = '/'.'storage/'.$photoPath;
            }
            else
            {
                $clients->photo = 'https://static.vecteezy.com/system/resources/thumbnails/002/534/006/small/social-media-chatting-online-blank-profile-picture-head-and-body-icon-people-standing-icon-grey-background-free-vector.jpg';
            }
            $clients->save();
            
            //Mailing Credentials
            $data["email"] = $request->input('email');
            $data["title"] = "Fonriven Client Credentials";
            $data["password"] = $password;
            
            Mail::send('mail.clientCredentialsMail', $data, function($message)use($data) {
                $message->to($data["email"], $data["email"])
                ->subject($data["title"]);
            });
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    //Create Client Account
    public function createSupplierRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'photo' => ['required','image'],
            'telephone' => ['required','unique:clients','digits_between:9,10'],
            'email' => ['required','unique:clients','email'],
            'role' => ['required'],
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
            $clients = new SupplierRequest;
            $clients->name = $request->input('name');
            $clients->telephone = $request->input('telephone');
            $clients->email = $request->input('email');
            $clients->role = $request->input('role');
            $clients->joined = NOW();
            $clients->status = 'pending';
            $clients->date = NOW();
            
            If(request('photo')!="")
            {
                $photoPath = request('photo')->store('client','public'); //get image path
                $clients->photo = '/'.'storage/'.$photoPath;
            }
            else
            {
                $clients->photo = 'https://static.vecteezy.com/system/resources/thumbnails/002/534/006/small/social-media-chatting-online-blank-profile-picture-head-and-body-icon-people-standing-icon-grey-background-free-vector.jpg';
            }
            $clients->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    //Edit Account
    public function editAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'id' => ['exists:clients'],
            'telephone' => ['required','digits_between:9,10'],
            'email' => ['required','email'],
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
            $clients = Client::find($request->input('id'));
            $clients->name = $request->input('name');
            $clients->telephone = $request->input('telephone');
            $clients->email = $request->input('email');
            
            If(request('photo')!="")
            {
                $photoPath = request('photo')->store('client','public'); //get image path
                $clients->photo = '/'.'storage/'.$photoPath;
            }

            $clients->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
}
