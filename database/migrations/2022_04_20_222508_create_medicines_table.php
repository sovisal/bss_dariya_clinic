<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medicines', function (Blueprint $table) {
			$table->id();
			$table->string('name')->nullable();
			$table->string('price')->nullable();
			$table->text('description')->nullable();
			$table->unsignedBigInteger('usage_id');
			$table->unsignedBigInteger('created_by');
			$table->unsignedBigInteger('updated_by');
			$table->timestamps();

			$table->foreign('usage_id')
					->references('id')
					->on('data_parents')
					->onUpdate('cascade')
					->onDelete('cascade');

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
		Schema::dropIfExists('medicines');
	}
}
