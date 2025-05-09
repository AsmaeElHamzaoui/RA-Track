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
        Schema::create('flight_reports', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('flight_id')->unique(); 
            $table->text('comment'); 
            $table->string('report_path'); 
            $table->timestamps(); 
            $table->foreign('flight_id')
                  ->references('id')
                  ->on('flights') 
                  ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flight_reports');
    }
};