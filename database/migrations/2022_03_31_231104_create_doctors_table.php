<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('doctors', function (Blueprint $table) {
			$table->id();
			$table->string('name_kh');
			$table->string('name_en')->nullable();
			$table->string('id_card_no')->nullable();
			$table->boolean('gender')->nullable();
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
			$table->text('address')->nullable();
			$table->unsignedBigInteger('created_by');
			$table->unsignedBigInteger('updated_by');
			$table->timestamps();
			
			$table->foreign('created_by')
					->references('id')
					->on('users')
					->onUpdate('cascade')
					->onDelete('cascade');

			$table->foreign('updated_by')
					->references('id')
					->on('users')
					->onUpdate('cascade')
					->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('doctors');
	}
}
