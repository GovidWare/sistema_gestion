<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title')->comment('Titulo');
            $table->text('description')->nullable()->comment('Descripción');
            $table->enum('status', ['HA', 'PR', 'CO'])->comment('Estado => HA: Por hacer, PR: En progreso, CO: Completada')->default('HA');
            $table->date('start_date')->nullable()->comment('Fecha inicial');
            $table->date('end_date')->nullable()->comment('Fecha final');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
