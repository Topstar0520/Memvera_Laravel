<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Members;
use Illuminate\Support\Facades\Validator;

class MembersController extends Controller
{
    public function index()
    {        
        $members = Members::where('is_deleted',0)->get();
        $menu = "members";
        return view('pages.members', compact('members', 'menu'));
    }
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:members,email',   // required and email format validation
            'birthday' => 'required', 

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json($validator->errors(), 422);
            // validation failed return back to form
        }else{
            
            $member = Members::create([
                'name' => $request->name,
                'email' => $request->email,
                'birthday' => $request->birthday,
            ]);
            
            return response()->json([
                "status" => true,
                "redirect_location" => "/members"
            ]);
        }
    }
    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',   // required and email format validation
            'birthday' => 'required', 

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json($validator->errors(), 422);
            // validation failed return back to form
        }else{
            $member = Members::where('email', $request->email)->where('is_deleted', 0)->where('id','!=', $request->member_id)->first();
            if (!is_null($member)) {                
                return response()->json([["The email has already been taken."]], 422);
            }
            Members::where('id', $request->member_id)->update([                
                "name" =>  $request->name,
                "email" =>  $request->email,
                "birthday" =>  $request->birthday
            ]);
            return response()->json([
                "status" => true,
                "redirect_location" => "/members"
            ]);
        }
    }
    public function delete(Request $request){
        // $member = Members::findOrFail($request->member_id);
        $member = Members::where('id', $request->member_id)->update([
            "is_deleted" =>  1,
            "deleted_at" =>  date("Y-m-d H:i:s"),
        ]);

        return redirect()->route('members');
    }
}
