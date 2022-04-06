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
            $table->string('id');
            $table->unsignedInteger('caller');
            $table->string('description')->nullable();
            $table->string('short_desc')->nullable();
            $table->unsignedInteger('created_by');
            $table->date('due_date')->nullable();
            $table->unsignedInteger('assignment_group');
            $table->unsignedInteger('assigned_to')->nullable();
            $table->unsignedInteger('category');
            $table->unsignedInteger('impact');
            $table->unsignedInteger('priority');
            $table->unsignedInteger('state');
            $table->unsignedInteger('resolved_by')->nullable();
            $table->unsignedInteger('resolution_code')->nullable();
            $table->string('resolution_note')->nullable();
            $table->date('resolution_date')->nullable();
            $table->timestamps();
            $table->foreign('caller')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('resolved_by')->references('id')->on('users');
            $table->foreign('resolution_code')->references('id')->on('resolution_codes');
            $table->foreign('assignment_group')->references('id')->on('user_groups');
            $table->foreign('assigned_to')->references('id')->on('users');
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
