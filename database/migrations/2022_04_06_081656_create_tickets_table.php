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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('caller');
            $table->string('description')->nullable();
            $table->string('short desc')->nullable();
            $table->unsignedInteger('created by');
            $table->date('due date')->nullable();
            $table->unsignedInteger('assignment group');
            $table->unsignedInteger('assigned to')->nullable();
            $table->unsignedInteger('category');
            $table->unsignedInteger('impact');
            $table->unsignedInteger('priority');
            $table->unsignedInteger('state');
            $table->unsignedInteger('resolved by')->nullable();
            $table->unsignedInteger('resolution code')->nullable();
            $table->string('resolution note')->nullable();
            $table->date('resolution date')->nullable();
            $table->timestamps();
            $table->foreign('caller')->references('id')->on('users');
            $table->foreign('created by')->references('id')->on('users');
            $table->foreign('resolved by')->references('id')->on('users');
            $table->foreign('resolution code')->references('id')->on('resolution_codes');
            $table->foreign('assignment group')->references('id')->on('user_groups');
            $table->foreign('assigned to')->references('id')->on('users');
            $table->foreign('category')->references('id')->on('ticket_categories');
            $table->foreign('impact')->references('id')->on('impact_levels');
            $table->foreign('priority')->references('id')->on('priorities');
            $table->foreign('state')->references('id')->on('ticket_states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
