<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class InquiryController extends Controller
{
    //get list of inquiries
    public function getInquiries($limit)
    {
        $inquiries = Inquiry::orderBy('id', 'DESC')->limit(6)->offSet($limit)->get();
        return response()->json([
            'inquiries'=>$inquiries,
        ]);
    }
    
    public function getOneInquiry($id)
    {
        $inquiries = Inquiry::where('id', '=', $id)->first();
        return response()->json([
            'inquiries'=>$inquiries,
        ]);
    }
    
    //respond to an inquiry
    public function respond(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inquiryID' => ['required'],
            'name' => ['required'],
            'email' => ['required','email'],
            'subject' => ['required'],
            'reply' => ['required'],
        ]); //validate all the data
        
        if ($validator->fails()) 
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        } 
        else 
        {
            //update inquiry status as read
            $inquiries = Inquiry::where('id','=',$request->input('inquiryID'))->first();
            $inquiries->status = 'responded';
            $inquiries->save();
            
            //Send a reply mail
            $data["email"] = $request->input('email');
            $data["title"] = "Inquiry Response";
            $data["subject"] = $request->input('subject');
            $data["reply"] = $request->input('reply');
            
            Mail::send('mail.inquiryReplyMail', $data, function ($message) use ($data) {
                $message->to($data["email"], $data["email"])
                ->subject($data["title"]);
            });
            
            return response()->json([
                'status'=>200,
            ]);
        }
    }
}
