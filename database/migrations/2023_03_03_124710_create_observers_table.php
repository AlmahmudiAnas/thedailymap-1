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
        Schema::create('observers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('num_of_posts')->unsigned()->change();
            $table->float('sw_lat',10,6);
            $table->float('sw_lng',10,6);
            $table->float('ne_lat',10,6);
            $table->float('ne_lng',10,6);
            $table->softDeletes();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('observers');
    }
};
