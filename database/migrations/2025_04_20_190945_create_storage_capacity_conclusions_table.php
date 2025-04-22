<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorageCapacityConclusionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_capacity_conclusions', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->unique()->nullable();
            $table->integer('type');
            $table->integer('measure_type');
            $table->date('given_date');
            $table->date('valid_date');
            $table->integer('organization_id');
            $table->float('capacity');
            $table->integer('director_id');
            $table->integer('result');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('storage_capacity_conclusions');
    }
}
