<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEchoTypesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('echo_types', function (Blueprint $table) {
			$table->id();
			$table->string('name_en')->nullable();
			$table->string('name_kh')->nullable();
			$table->string('price', 10)->default(0);
			$table->integer('index')->default(99999);
			$table->text('attribite')->nullable();
			$table->text('default_form')->nullable();
			$table->integer('status')->default(1);
			$table->text('other')->nullable();
			$table->timestamps();
		});

		// Insert some stuff
		DB::table('echo_types')->insert([
			[
				'name_en' => 'ការពិនិត្យផ្ទៃពោះ',
				'name_kh' => 'ការពិនិត្យផ្ទៃពោះ',
				'index' => 1,
				'id' => 1,
			],
			[
				'name_en' => 'ការពិនិត្យផ្ទៃពោះនៅត្រីមាសទី ១',
				'name_kh' => 'ការពិនិត្យផ្ទៃពោះនៅត្រីមាសទី ១',
				'index' => 2,
				'id' => 2,
			],
			[
				'name_en' => 'ការពិនិត្យផ្ទៃពោះនៅត្រីមាសទី ២',
				'name_kh' => 'ការពិនិត្យផ្ទៃពោះនៅត្រីមាសទី ២',
				'index' => 3,
				'id' => 3,
			],
			[
				'name_en' => 'ការពិនិត្យផ្ទៃពោះនៅត្រីមាសទី ៣',
				'name_kh' => 'ការពិនិត្យផ្ទៃពោះនៅត្រីមាសទី ៣',
				'index' => 4,
				'id' => 4,
			],
			[
				'name_en' => 'abdominal ultrasound',
				'name_kh' => 'abdominal ultrasound',
				'index' => 5,
				'id' => 5,
			],
			[
				'name_en' => 'ABDOMINO - ADENOPATHY',
				'name_kh' => 'ABDOMINO - ADENOPATHY',
				'index' => 6,
				'id' => 6,
			],
			[
				'name_en' => 'ACUTE APPENDICITIS',
				'name_kh' => 'ACUTE APPENDICITIS',
				'index' => 7,
				'id' => 7,
			],
			[
				'name_en' => 'APPENDICITIS',
				'name_kh' => 'APPENDICITIS',
				'index' => 8,
				'id' => 8,
			],
			[
				'name_en' => 'BREAST',
				'name_kh' => 'BREAST',
				'index' => 9,
				'id' => 9,
			],
			[
				'name_en' => 'cevic',
				'name_kh' => 'cevic',
				'index' => 10,
				'id' => 10,
			],
			[
				'name_en' => 'CHC',
				'name_kh' => 'CHC',
				'index' => 11,
				'id' => 11,
			],
			[
				'name_en' => 'CHRONIC CYSTITIS',
				'name_kh' => 'CHRONIC CYSTITIS',
				'index' => 12,
				'id' => 12,
			],
			[
				'name_en' => 'Echo abdomino pelvice normal ',
				'name_kh' => 'Echo abdomino pelvice normal ',
				'index' => 13,
				'id' => 13,
			],
			[
				'name_en' => 'ECHOGRAPHY',
				'name_kh' => 'ECHOGRAPHY',
				'index' => 14,
				'id' => 14,
			],
			[
				'name_en' => 'ECOCARDIOGRAPHIE ',
				'name_kh' => 'ECOCARDIOGRAPHIE ',
				'index' => 15,
				'id' => 15,
			],
			[
				'name_en' => 'ECOGRAPHIE',
				'name_kh' => 'ECOGRAPHIE',
				'index' => 16,
				'id' => 16,
			],
			[
				'name_en' => 'Examen du sein ',
				'name_kh' => 'Examen du sein ',
				'index' => 17,
				'id' => 17,
			],
			[
				'name_en' => 'GALLBLADDER STONE ',
				'name_kh' => 'GALLBLADDER STONE ',
				'index' => 18,
				'id' => 18,
			],
			[
				'name_en' => 'Goiter',
				'name_kh' => 'Goiter',
				'index' => 19,
				'id' => 19,
			],
			[
				'name_en' => 'HEART FAILURE ',
				'name_kh' => 'HEART FAILURE ',
				'index' => 20,
				'id' => 20,
			],
			[
				'name_en' => 'KNEE',
				'name_kh' => 'KNEE',
				'index' => 21,
				'id' => 21,
			],
			[
				'name_en' => 'Left breast cyst',
				'name_kh' => 'Left breast cyst',
				'index' => 22,
				'id' => 22,
			],
			[
				'name_en' => 'MILD HYDRONEPHROSIS',
				'name_kh' => 'MILD HYDRONEPHROSIS',
				'index' => 23,
				'id' => 23,
			],
			[
				'name_en' => 'Multi lobar liver abscess',
				'name_kh' => 'Multi lobar liver abscess',
				'index' => 24,
				'id' => 24,
			],
			[
				'name_en' => 'NECK ',
				'name_kh' => 'NECK ',
				'index' => 25,
				'id' => 25,
			],
			[
				'name_en' => 'NECK copy',
				'name_kh' => 'NECK copy',
				'index' => 26,
				'id' => 26,
			],
			[
				'name_en' => 'NECK ECHOGRAPHY ',
				'name_kh' => 'NECK ECHOGRAPHY ',
				'index' => 27,
				'id' => 27,
			],
			[
				'name_en' => 'PERITONITIS BY GASTRIC PERFORATION',
				'name_kh' => 'PERITONITIS BY GASTRIC PERFORATION',
				'index' => 28,
				'id' => 28,
			],
			[
				'name_en' => 'RIGHT PSOAS abscess ',
				'name_kh' => 'RIGHT PSOAS abscess ',
				'index' => 29,
				'id' => 29,
			],
			[
				'name_en' => 'RIGHT RENAL CYST',
				'name_kh' => 'RIGHT RENAL CYST',
				'index' => 30,
				'id' => 30,
			],
			[
				'name_en' => 'RIGHT RENAL STONES + HYDRONEPHROSIS ',
				'name_kh' => 'RIGHT RENAL STONES + HYDRONEPHROSIS ',
				'index' => 31,
				'id' => 31,
			],
			[
				'name_en' => 'THYROID GLAND',
				'name_kh' => 'THYROID GLAND',
				'index' => 32,
				'id' => 32,
			],
			[
				'name_en' => 'Tumefaction',
				'name_kh' => 'Tumefaction',
				'index' => 33,
				'id' => 33,
			],
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('echo_types');
	}
}
