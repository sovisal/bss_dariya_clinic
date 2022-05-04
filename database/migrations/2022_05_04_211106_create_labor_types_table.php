<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateLaborTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labor_types', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->nullable();
            $table->string('name_kh')->nullable();
            $table->integer('index')->default(99999);
            $table->integer('status')->default(1);
            $table->text('other')->nullable();
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('labor_types')->insert([
            [
                'name_en' => 'BACTERIOLOGIE',
                'name_kh' => 'BACTERIOLOGIE',
                'index' => 1
            ],
            [
                'name_en' => 'BIOCHIMIE',
                'name_kh' => 'BIOCHIMIE',
                'index' => 2
            ],
            [
                'name_en' => 'dematology',
                'name_kh' => 'dematology',
                'index' => 3
            ],
            [
                'name_en' => '- skin',
                'name_kh' => '- skin',
                'index' => 4
            ],
            [
                'name_en' => 'HEMATOLOGIE',
                'name_kh' => 'HEMATOLOGIE',
                'index' => 5
            ],
            [
                'name_en' => '- FORMULE LEUCOCYTAIRE:',
                'name_kh' => '- FORMULE LEUCOCYTAIRE:',
                'index' => 6
            ],
            [
                'name_en' => '- HbA1C',
                'name_kh' => '- HbA1C',
                'index' => 7
            ],
            [
                'name_en' => '- NUMERATION GLOBULAIRI:',
                'name_kh' => '- NUMERATION GLOBULAIRI:',
                'index' => 8
            ],
            [
                'name_en' => 'SELLE',
                'name_kh' => 'SELLE',
                'index' => 9
            ],
            [
                'name_en' => 'SEROLOGIES',
                'name_kh' => 'SEROLOGIES',
                'index' => 10
            ],
            [
                'name_en' => '- DIAGNOSTIC DE TREPONEMATOSES',
                'name_kh' => '- DIAGNOSTIC DE TREPONEMATOSES',
                'index' => 11
            ],
            [
                'name_en' => '- REACTION DE WALER ROSE',
                'name_kh' => '- REACTION DE WALER ROSE',
                'index' => 12
            ],
            [
                'name_en' => '- Serodiagnostic de widal (salmonelloses)',
                'name_kh' => '- Serodiagnostic de widal (salmonelloses)',
                'index' => 13
            ],
            [
                'name_en' => '- SEROLOGIE DE H.I.V. 1 / 2 ',
                'name_kh' => '- SEROLOGIE DE H.I.V. 1 / 2 ',
                'index' => 14
            ],
            [
                'name_en' => "- SEROLOGIE DE L'HEPATITE B,C",
                'name_kh' => "- SEROLOGIE DE L'HEPATITE B,C",
                'index' => 15
            ],
            [
                'name_en' => '- SEROLOGIE DES INFECTIONS A STREPTOCOQUE',
                'name_kh' => '- SEROLOGIE DES INFECTIONS A STREPTOCOQUE',
                'index' => 16
            ],
            [
                'name_en' => '- Serology de Helicobacter pylori ',
                'name_kh' => '- Serology de Helicobacter pylori ',
                'index' => 17
            ],
            [
                'name_en' => '- TEST DE LATEX POUR DETECTION PROTEIN C (CRP)',
                'name_kh' => '- TEST DE LATEX POUR DETECTION PROTEIN C (CRP)',
                'index' => 18
            ],
            [
                'name_en' => 'URINARIES ANALYSES',
                'name_kh' => 'URINARIES ANALYSES',
                'index' => 19
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labor_types');
    }
}
