<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->text('content');
            $table->integer('priority_number')->default(0);
            $table->enum('type', ['daily', 'weekly', 'monthly', '-'])->default('-');
            $table->datetime('deadline')->nullable();
            $table->enum('status', ['cancelled', 'done', 'doing'])->default('doing');
            // $table->datetime('finished_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
