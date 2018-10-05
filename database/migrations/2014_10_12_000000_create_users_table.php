<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('company_id');
            $table->integer('supervisor_id');
            $table->integer('itf_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('school');
            $table->string('matric_no')->unique();
            $table->string('faculty');
            $table->string('course');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('state');
            $table->rememberToken();
            $table->timestamps();
            $table->integer('tracker')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
