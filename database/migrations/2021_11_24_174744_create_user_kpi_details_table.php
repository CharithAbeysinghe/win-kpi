<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserKpiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_kpi_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_kpi_id');
            $table->foreign('user_kpi_id')->references('id')->on('user_kpis');
            $table->unsignedBigInteger('kpi_id');
            $table->foreign('kpi_id')->references('id')->on('kpis');
            $table->unsignedBigInteger('kpi_option_id');
            $table->foreign('kpi_option_id')->references('id')->on('kpi_options');
            $table->string('amount');
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
        Schema::dropIfExists('user_kpi_details');
    }
}
