<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbilityModulesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ability_modules', function (Blueprint $table) {
			$table->id();
			$table->string('module')->unique();
			$table->timestamps();
		});

		Schema::table('abilities', function (Blueprint $table) {
			$table->string('category')->after('label');
			$table->unsignedBigInteger('ability_module_id')->after('category');
			$table->foreign('ability_module_id')
					->references('id')
					->on('ability_modules')
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
		Schema::dropIfExists('ability_modules');
		Schema::table('sales', function (Blueprint $table) {
			$table->dropForeign('abilities_ability_modules_ability_module_id_foreign');
			$table->dropColumn('ability_module_id');
		});
	}
}
