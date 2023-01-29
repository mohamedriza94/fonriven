<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Inquiry;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    //for buyer to send a message to supplier or vice versa
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
            
            //custom path based on the sender's role
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
    
    //for the logged in user to view messages belonging to him/her
    public function getMessages($type)
    {
        if(auth()->guard('client')->user()->role == "supplier")
        {   
            //when a supplier is logged in
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
        { //when a buyer is logged in
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
    
    //get details of the sender/recipient of a message
    public function getEntity($no)
    {
        $entity = Client::where('id','=',$no)->first();
        return response()->json([
            'entity'=>$entity,
        ]);
    }
    
    //delete a message
    public function deleteMessage(Request $request)
    {
        $messages = Message::where('id','=',$request->input('id'))->delete();
        
        return response()->json([
            'status'=>200
        ]);
    }
    
    //view details of a single message
    public function getOneMessage($id)
    {
        //supplier is the sender
        $messages = Message::where('id','=',$id)->first();
        
        return response()->json([
            'messages'=>$messages,
        ]);
    }

    //reply to a message
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
            //update message status
            $messages = Message::where('id','=',$request->input('messageID'))->first();
            $messages->status = 'read'; 
            $messages->save();
            
            //Sending reply via mail
            $data["recipientEmail"] = $request->input('messageEmail');
            $data["senderEmail"] = auth()->guard('client')->user()->email;
            $data["title"] = "Reply Message";
            $data["messageSubject"] = $request->input('messageSubject');
            $data["messageDate"] = NOW();
            $data["reply"] = $request->input('reply');
            
            Mail::send('mail.replyMail', $data, function($message)use($data) {
                $message->to($data["recipientEmail"], $data["recipientEmail"])->from($data["senderEmail"], $data["senderEmail"])
                ->subject($data["title"]);
            });
            
            return response()->json([
                'status'=>200
            ]);
        }
    }

    //for all types of users including guests to make an inquiry
    public function inquire(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inquiryName' => ['required'],
            'inquiryTelephone' => ['required'],
            'inquiryEmail' => ['required'],
            'inquirySubject' => ['required'],
            'inquiryMessage' => ['required'],
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
            //save inquiry into database
            $inquiries = new Inquiry;
            $inquiries->name = $request->input('inquiryName');
            $inquiries->telephone = $request->input('inquiryTelephone');
            $inquiries->email = $request->input('inquiryEmail');
            $inquiries->subject = $request->input('inquirySubject');
            $inquiries->status = 'unread';
            $inquiries->message = $request->input('inquiryMessage');
            $inquiries->date = NOW();
            $inquiries->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
}
