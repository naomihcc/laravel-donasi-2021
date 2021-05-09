<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefAgama extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_agama', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->boolean('is_active');
            $table->date('inserted_at');
            $table->bigInteger('inserted_by');
            $table->date('edited_at')->nullable();
            $table->bigInteger('edited_by')->nullable();
        });

        Schema::table('ref_agama', function($table) {
            $table->foreign('inserted_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('edited_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_agama');
    }
}
