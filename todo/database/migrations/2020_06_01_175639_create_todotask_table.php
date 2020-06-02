<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodotaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todotasks', function (Blueprint $table) {
            $table->id();
            $table->string('task')->comment('Tasks todo');
            $table->text('task_description')->nullable()->comment('Tasks description');
            $table->tinyInteger('finished')->default(0)->comment('Finished / not finished flag');
            $table->timestamp('finished_at')->nullable();
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
        Schema::dropIfExists('todotasks');
    }
}
