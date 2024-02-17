<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("campaign_id");
            $table->unsignedBigInteger("member_id");
            $table->dateTime('send_time')->nullable();
            
            $table->foreign("campaign_id")->references("id")->on("campaigns")->onDelete("cascade");
            $table->foreign("member_id")->references("id")->on("members")->onDelete("cascade");
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emails');
    }
};
