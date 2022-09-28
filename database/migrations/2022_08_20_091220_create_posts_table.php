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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            //
            $table->integer('user_id')->unsigned()->default(0);
            $table->string('title123');
            $table->text('testtest123');
            //$table->string('title123')->unique();
            //$table->string('title123')->nullable();
            //$table->string('title123')->nullable();
            //$table->string('title123')->unsign();
            //

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
        Schema::dropIfExists('posts');
    }
};
