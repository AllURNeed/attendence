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
        Schema::create('adminlogin', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('school')->default('Enter School Name');
            $table->string('school_time')->default('07:00');
            $table->timestamps();
        });

        DB::table('adminlogin')->insert([
            "username"=>"admin",
           // "password"=>Hash::make('admin')
           "password"=>md5('admin')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adminlogin');
    }
};
