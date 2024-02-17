<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Members;
use App\Models\Campaigns;
use App\Models\Emails;
use Illuminate\Support\Facades\Validator;
use App\Mail\TemplateEmail;
use Illuminate\Support\Facades\Mail;

class CampaignsController extends Controller
{
    public function index()
    {        
        $campaigns = Campaigns::where('is_deleted',0)->get();
        $members = Members::where('is_deleted',0)->get();
        $menu = "campaigns";
        return view('pages.campaigns', compact('campaigns', 'members', 'menu'));
    }
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'subject' => 'required|min:3',   
            'content' => 'required|min:3',   

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json($validator->errors(), 422);
            // validation failed return back to form
        }else{
            
            $member = Campaigns::create([
                'name' => $request->name,
                'subject' => $request->subject,
                'content' => $request->content,
            ]);
            
            return response()->json([
                "status" => true,
                "redirect_location" => "/campaigns"
            ]);
        }
    }
    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'subject' => 'required|min:3',   
            'content' => 'required|min:3',   

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json($validator->errors(), 422);
            // validation failed return back to form
        }else{
            Campaigns::where('id', $request->campaign_id)->update([   
                'name' => $request->name,
                'subject' => $request->subject,
                'content' => $request->content,
            ]);
            return response()->json([
                "status" => true,
                "redirect_location" => "/campaigns"
            ]);
        }
    }
    public function delete(Request $request){

        $member = Campaigns::where('id', $request->campaign_id)->update([
            "is_deleted" =>  1,
            "deleted_at" =>  date("Y-m-d H:i:s"),
        ]);

        return redirect()->route('campaigns');
    }
    public function send(Request $request){
        if(!isset($request->members)){
            return response()->json([["You must select the member."]], 422);
        }
        $cnt = 0;
        foreach($request->members as $member_id=>$member){
            $cnt++;
            $member_name = Members::where("id", $member_id)->first()->name;
            $email = Emails::create([
                'member_id' => $member_id,
                'campaign_id' => $request->campaign_id,
                'send_time' => date("Y-m-d H:i:s")
            ]);
            
            // The email sending is done using the to method on the Mail facade
            Mail::to($email->member->email)->send(new TemplateEmail($email->member->name,$email->campaign->subject,$email->campaign->content));
        }
        return response()->json([
            "status" => true,
            "msg" => "You sent the email to <b>".($cnt>1?strval($cnt)."</b> members":$member_name."</b>."),
            "redirect_location" => "/campaigns"
        ]);
    }
}



