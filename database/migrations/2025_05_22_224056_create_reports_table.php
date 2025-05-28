<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('location');
            $table->float('latitude');
            $table->float('longitude');
            $table->string('type');
            $table->string('size');
            $table->string('urgency');
            $table->text('description')->nullable();
            $table->longtext('photos')->nullable(); // Ganti json dengan longtext
            $table->string('province')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
