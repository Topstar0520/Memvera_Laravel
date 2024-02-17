<?php

namespace App\Models;

use App\Models\Members;
use App\Models\Campaigns;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id', 'campaign_id', 'send_time',
    ];
    
    public function campaign(){
        return $this->belongsTo(Campaigns::class,"campaign_id","id");
    }
    public function member(){
        return $this->belongsTo(Members::class,"member_id","id");
    }

    
    public function member_data(){
        return $this->belongsTo(Members::class,"member_id","id")->select("id","name","email","birthday");
    }
}
