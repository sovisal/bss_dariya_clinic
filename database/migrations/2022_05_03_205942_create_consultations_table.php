<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('consultations', function (Blueprint $table) {
			$table->id();
			$table->text('attribute')->nullable();
			$table->string('payment_type')->nullable();
			$table->datetime('evaluated_at');
			$table->string('status')->default('save');
			$table->unsignedBigInteger('patient_id');
			$table->unsignedBigInteger('doctor_id');
			$table->unsignedBigInteger('created_by');
			$table->unsignedBigInteger('updated_by');
			$table->timestamps();

			$table->foreign('patient_id')
					->references('id')
					->on('patients')
					->onUpdate('cascade')
					->onDelete('cascade');

			$table->foreign('doctor_id')
					->references('id')
					->on('doctors')
					->onUpdate('cascade')
					->onDelete('cascade');

			$table->foreign('created_by')
					->references('id')
					->on('users')
					->onUpdate('no action')
					->onDelete('no action');
			$table->foreign('updated_by')
					->references('id')
					->on('users')
					->onUpdate('no action')
					->onDelete('no action');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('consultations');
	}
}
