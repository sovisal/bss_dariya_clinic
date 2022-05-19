<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prescription_id')->default(0);
            $table->unsignedBigInteger('medicine_id')->default(0);
            $table->string('qty', 10)->default(0);
            $table->string('upd', 10)->default(0);
            $table->string('nod', 10)->default(0);
            $table->string('total', 10)->default(0);
            $table->string('unit', 10)->default(0);
            $table->string('usage_times')->default('');
            $table->unsignedBigInteger('usage_id')->default(0);
            $table->text('other')->nullable();
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
        Schema::dropIfExists('prescription_details');
    }
}
