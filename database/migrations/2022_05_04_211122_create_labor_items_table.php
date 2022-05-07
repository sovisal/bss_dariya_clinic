<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaborItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labor_items', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->nullable();
            $table->string('name_kh')->nullable();
            $table->string('min_range')->nullable();
            $table->string('max_range')->nullable();
            $table->string('unit')->nullable();
            $table->unsignedBigInteger('type')->default(0);
            $table->integer('status')->default(1);
            $table->integer('index')->default(9999);
            $table->text('other')->nullable();
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('labor_items')->insert([
            [
                'name_en' => 'Leucocytes',
                'name_kh' => 'Leucocytes',
                'min_range' => '100',
                'max_range' => '200',
                'unit' => '10<sup>3</sup>3/uL',
                'type' => 1
            ],
            [
                'name_en' => 'Hématies',
                'name_kh' => 'Hématies',
                'min_range' => '10',
                'max_range' => '20',
                'unit' => '10<sup>6</sup>6/uL',
                'type' => 1
            ],
            [
                'name_en' => 'Polynucléaire neutrophile',
                'name_kh' => 'Polynucléaire neutrophile',
                'min_range' => '1',
                'max_range' => '100',
                'unit' => '%',
                'type' => 2
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
        Schema::dropIfExists('labor_items');
    }
}
