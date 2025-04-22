<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConclusionResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_conclusion_files_data', function (Blueprint $table) {
            $table->id();
            $table->integer('conclusion_id');
            $table->integer('type');
            $table->integer('state_id');
            $table->string('name');
            $table->date('date');
            $table->string('number');
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('storage_conclusion_files_data');
    }
}
