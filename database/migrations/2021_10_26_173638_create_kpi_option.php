<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKpiOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpi_options', function (Blueprint $table) {
            // $table->id();
            // $table->string('kpi_option');
            // $table->unsignedBigInteger('kpi_id');
            // $table->foreign('kpi_id')->references('id')->on('kpis');
            // $table->timestamps();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kpi_options');
    }
}
