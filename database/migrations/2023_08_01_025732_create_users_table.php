<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments("iduser");
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('session')->nullable();
            $table->dateTime('datelogin')->nullable();
            $table->dateTime('datelogout')->nullable();
            $table->dateTime('dateregister')->nullable();
            //$table->timestamps();
        });

        DB::table('users')->insert([
            ['name' => 'heru', 'email' => "heru@email.com",'password' => '202cb962ac59075b964b07152d234b70','role' => 'user','session' => 'e3942edaeeb5379e2e03a521e43feeec4ccfb264','datelogin' => '2023-08-02 14:01:01','datelogout' => '2023-08-02 14:01:01','dateregister' => '2023-08-02 14:01:01'],
            ['name' => 'abdi', 'email' => "abdi@email.com",'password' => '11202cb962ac59075b964b07152d234b70','role' => 'user','session' => 'e3942edaeeb5379e2e03a521e43feeec4ccfb264','datelogin' => '2023-08-02 14:01:01','datelogout' => '2023-08-02 14:01:01','dateregister' => '2023-08-02 14:01:01'],
        ]);

    }

    /**
     * Reverse the migratio
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
