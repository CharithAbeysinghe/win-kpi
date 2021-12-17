<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserKpiTotalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_kpi_totals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_kpi_id');
            $table->foreign('user_kpi_id')->references('id')->on('user_kpis');
            $table->unsignedBigInteger('kpi_eq_id');
            $table->foreign('kpi_eq_id')->references('id')->on('kpi_calculations');
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
        Schema::dropIfExists('user_kpi_totals');
    }
}
