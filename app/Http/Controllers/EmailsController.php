<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emails;

class EmailsController extends Controller
{
    public function index()
    {        
        $emails = Emails::orderby('send_time','desc')->get();
        $menu = "emails";
        return view('pages.emails', compact('emails', 'menu'));
    }
}
