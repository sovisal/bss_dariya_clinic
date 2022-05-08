<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecgs', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->unsignedBigInteger('patient_id')->default(0);
            $table->unsignedBigInteger('doctor_id')->default(0);
            $table->unsignedBigInteger('requested_by')->default(0);
            $table->unsignedBigInteger('type')->default(0);
            $table->unsignedBigInteger('payment_type')->default(0);
            $table->unsignedBigInteger('payment_status')->default(0);
            $table->datetime('requested_at')->nullable();
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('amount', 10)->default(0);
            $table->integer('status')->default(1);
            $table->text('attribute')->nullable();
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
        Schema::dropIfExists('ecgs');
    }
}
