<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    //Add Product
    public function addProduct(Request $request)
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
}
