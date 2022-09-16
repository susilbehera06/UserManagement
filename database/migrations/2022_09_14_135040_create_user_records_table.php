<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_records', function (Blueprint $table) {
            $table->id();
            $table->string('fname',80);
            $table->string('email',80);
            $table->string('join_date');
            $table->string('leave_date')->nullable();
            $table->integer('status')->default(0);
            $table->string('avatar');
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
        Schema::dropIfExists('user_records');
    }
}
