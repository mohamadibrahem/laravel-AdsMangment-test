<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->date('from');
            $table->date('to');
            $table->float('total', 15, 2);
            $table->float('daily_budget', 15, 2);
            $table->timestamps();
        });
    }
}
