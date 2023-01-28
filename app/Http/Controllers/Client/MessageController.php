<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function composeMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => ['required'],
            'message' => ['required'],
            'recipient' => ['required'],
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
            $messages = new Message;
            $messages->subject = $request->input('subject');
            $messages->message = $request->input('message'); 
            $messages->date = NOW();
            $messages->status = 'unread';
            
            if(auth()->guard('client')->user()->role == "supplier")
            {
                $messages->path = 'supplierToBuyer';
            }
            else
            {
                $messages->path = 'buyerToSupplier';
            }
            
            $messages->sender = auth()->guard('client')->user()->id;
            $messages->recipient = $request->input('recipient');  
            $messages->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function getMessages($type)
    {
        if(auth()->guard('client')->user()->role == "supplier")
        {
            if($type=="supplierTo")
            {
                //supplier is the sender
                $messages = Message::where('sender','=',auth()->guard('client')->user()->id)->orderBy('id','DESC')->get();
                
                return response()->json([
                    'messages'=>$messages,
                ]);
            }
            else
            {
                //supplier is the recipient
                $messages = Message::where('recipient','=',auth()->guard('client')->user()->id)->orderBy('id','DESC')->get();
                
                return response()->json([
                    'messages'=>$messages,
                ]);
            }
        }
        else
        {
            if($type=="buyerTo")
            {
                //buyer is the sender
                $messages = Message::where('sender','=',auth()->guard('client')->user()->id)->orderBy('id','DESC')->get();
                
                return response()->json([
                    'messages'=>$messages,
                ]);
            }
            else
            {
                //buyer is the recipient
                $messages = Message::where('recipient','=',auth()->guard('client')->user()->id)->orderBy('id','DESC')->get();
                
                return response()->json([
                    'messages'=>$messages,
                ]);
            }
        }
        
    }
    
    public function getEntity($no)
    {
        $entity = Client::where('id','=',$no)->first();
        return response()->json([
            'entity'=>$entity,
        ]);
    }

    public function deleteMessage(Request $request)
    {
            $messages = Message::where('id','=',$request->input('id'))->delete();

            return response()->json([
                'status'=>200
            ]);
    }
    
    public function getOneMessage($id)
    {
        //supplier is the sender
        $messages = Message::where('id','=',$id)->first();
                
        return response()->json([
            'messages'=>$messages,
        ]);
    }
    public function reply(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'messageID' => ['required'],
            'messageSubject' => ['required'],
            'messageDate' => ['required'],
            'messageEmail' => ['required'],
            'reply' => ['required'],
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
            $messages = Message::where('id','=',$request->input('messageID'));
            $messages->status = 'read';
            $messages->recipient = $request->input('recipient');  
            $messages->save();

            
            return response()->json([
                'status'=>200
            ]);
        }
    }
}
