<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Members;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $members = Members::all();
        foreach ($members as $member) {
            if($member->birthday == date("Y-m-d")){ //Or however your date field on user is called
    
                Mail::send('email.birthday', ['member_name' => $member->name], function ($message) use ($member) {
                    $message->to($member->email);
                    $message->subject('Happy Birthday');
                });
            }
        }

        $this->info('The emails are send successfully!');
    }
}
