<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->index();
            $table->string('filename');
            $table->string('ext');
            $table->string('thumb');
            $table->text('path');
            $table->timestamps();
        });
        
        Schema::create('photoables', function (Blueprint $table) {
            $table->bigInteger('photo_id')->index();
            $table->bigInteger('photoable_id')->index();
            $table->string('photoable_type');
            $table->timestamps();
            $table->unique(['photo_id', 'photoable_id', 'photoable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
