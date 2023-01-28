<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Connection;
use App\Models\Client;
use Illuminate\Support\Facades\Mail;

class ConnectionController extends Controller
{
    //Create Buyer Account
    public function makeConnection(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier' => ['required'],
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
            $buyerNo = auth()->guard('client')->user()->id;

            $checkConnectionExistance = Connection::where('buyer','=',$buyerNo)
            ->where('supplier','=',$request->input('supplier'))->where('status','=','active')
            ->first();

            if($checkConnectionExistance)
            {
                return response()->json([
                    'status'=>404
                ]);
            }
            else
            {
                $no = rand(1999,99999);

                $connections = new Connection;
                $connections->no = $no;
                $connections->buyer = $buyerNo;
                $connections->supplier = $request->input('supplier');
                $connections->date = NOW();
                $connections->status = 'active';
                $connections->save();
                
                //get buyer email
                $buyer = Client::where('id','=',$buyerNo)->first();
                $buyerName = $buyer['name'];
                $buyerTelephone = $buyer['telephone'];
    
                //get supplier email
                $supplier = Client::where('id','=',$request->input('supplier'))->first();
                $supplierEmail = $supplier['email'];
            
                //Mail to Buyer
                $data["email"] = $supplierEmail;
                $data["title"] = "New Connection";
                $data["buyerName"] = $buyerName;
                $data["buyerTelephone"] = $buyerTelephone;
                $data["connectionNo"] = $no;
                $data["date"] = NOW();
                
                Mail::send('mail.supplierConnectionMail', $data, function($message)use($data) {
                    $message->to($data["email"], $data["email"])
                    ->subject($data["title"]);
                });

                return response()->json([
                    'status'=>200
                ]);
            }
        }
    }

    public function viewConnections()
    {
        $connections = Connection::join('clients','clients.id', '=', 'connections.supplier')
            ->where('connections.buyer','=',auth()->guard('client')->user()->id)->orderBy('connections.id','DESC')
            ->get([
                'connections.no AS connectionNo',
                'clients.photo AS supplierPhoto',
                'clients.name AS supplierName',
                'connections.date AS connectionDate',
                'connections.status AS connectionStatus',
                'connections.supplier AS supplierNo'
            ]);

            return response()->json([
                'connections' => $connections
            ]);
    }

    public function searchConnections($search)
    {
        $connections = Connection::join('clients','clients.id', '=', 'connections.supplier')
            ->where('connections.buyer','=',auth()->guard('client')->user()->id)
            ->where('connections.no','LIKE','%'.$search.'%')
            ->orderBy('connections.id','DESC')
            ->get([
                'connections.no AS connectionNo',
                'clients.photo AS supplierPhoto',
                'clients.name AS supplierName',
                'connections.date AS connectionDate',
                'connections.status AS connectionStatus',
                'connections.supplier AS supplierNo'
            ]);

            return response()->json([
                'connections' => $connections
            ]);
    }

    public function viewOneConnection($connectionNo)
    {
        $connections = Connection::join('clients','clients.id', '=', 'connections.supplier')
            ->where('connections.no','=',$connectionNo)
            ->first([
                'connections.no AS connectionNo',
                'connections.date AS connectionDate',
                'connections.status AS connectionStatus',
                'connections.supplier AS supplierNo',
                'clients.photo AS supplierPhoto',
                'clients.telephone AS supplierTelephone',
                'clients.email AS supplierEmail',
                'clients.name AS supplierName'
            ]);

            return response()->json([
                'connections' => $connections
            ]);
    }

    public function endConnection(Request $request)
    {
            $connections = Connection::where('no','=',$request->input('no'))->first();
            $connections->status = $request->input('status');
            $connections->save();

            return response()->json([
                'status'=>200
            ]);
    }
}
