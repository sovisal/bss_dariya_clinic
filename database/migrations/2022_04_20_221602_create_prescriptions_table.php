<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->unsignedBigInteger('patient_id')->default(0);
            
            $table->unsignedBigInteger('requested_by')->default(0);
            $table->datetime('requested_at')->nullable();

            $table->unsignedBigInteger('doctor_id')->default(0);
            $table->datetime('analysis_at')->nullable();

            $table->text('diagnosis')->nullable();
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
        Schema::dropIfExists('prescriptions');
    }
}
