<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_parents', function (Blueprint $table) {
            $table->id();
            $table->string('title_en', 255)->nullable();
            $table->string('title_kh', 255)->nullable();
            $table->string('type', 50)->nullable();
            $table->text('description')->nullable();
            $table->text('other')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('data_parents')->insert([
            [
                'title_en' => 'Male',
                'title_kh' => 'Male',
                'type' => 'gender'
            ],
            [
                'title_en' => 'Female',
                'title_kh' => 'Female',
                'type' => 'gender'
            ],
            [
                'title_en' => 'Other',
                'title_kh' => 'Other',
                'type' => 'gender'
            ],

            [
                'title_en' => 'Single',
                'title_kh' => 'Single',
                'type' => 'marital_status'
            ],
            [
                'title_en' => 'Married',
                'title_kh' => 'Married',
                'type' => 'marital_status'
            ],

            [
                'title_en' => 'O+',
                'title_kh' => 'O+',
                'type' => 'blood_type'
            ],
            [
                'title_en' => 'A',
                'title_kh' => 'A',
                'type' => 'blood_type'
            ],
            [
                'title_en' => 'B',
                'title_kh' => 'B',
                'type' => 'blood_type'
            ],

            [
                'title_en' => 'Cambodian',
                'title_kh' => 'Cambodian',
                'type' => 'nationality'
            ],
            [
                'title_en' => 'English',
                'title_kh' => 'English',
                'type' => 'nationality'
            ],
            [
                'title_en' => 'Other',
                'title_kh' => 'Other',
                'type' => 'nationality'
            ],

            [
                'title_en' => 'General',
                'title_kh' => 'General',
                'type' => 'enterprise'
            ],
            [
                'title_en' => 'Government',
                'title_kh' => 'Government',
                'type' => 'enterprise'
            ],

            [
                'title_en' => 'General',
                'title_kh' => 'General',
                'type' => 'payment_type'
            ],


            [
                'title_en' => 'លេប',
                'title_kh' => 'លេប',
                'type' => 'comsumption'
            ],
            [
                'title_en' => 'ចាក់',
                'title_kh' => 'ចាក់',
                'type' => 'comsumption'
            ],
            [
                'title_en' => 'ទំពារ',
                'title_kh' => 'ទំពារ',
                'type' => 'comsumption'
            ],
            [
                'title_en' => 'សុល',
                'title_kh' => 'សុល',
                'type' => 'comsumption'
            ],
            [
                'title_en' => 'ថ្នាំបុក',
                'title_kh' => 'ថ្នាំបុក',
                'type' => 'comsumption'
            ],
            [
                'title_en' => 'លាយទឹកញ៉ាំ',
                'title_kh' => 'លាយទឹកញ៉ាំ',
                'type' => 'comsumption'
            ],
            [
                'title_en' => 'ព្យួរសេរូ៉ម',
                'title_kh' => 'ព្យួរសេរូ៉ម',
                'type' => 'comsumption'
            ],
            [
                'title_en' => 'ស្ពុង',
                'title_kh' => 'ស្ពុង',
                'type' => 'comsumption'
            ],

            [
                'title_en' => 'Morning',
                'title_kh' => 'Morning',
                'type' => 'time_usage'
            ],
            [
                'title_en' => 'Noon',
                'title_kh' => 'Noon',
                'type' => 'time_usage'
            ],
            [
                'title_en' => 'Evening',
                'title_kh' => 'Evening',
                'type' => 'time_usage'
            ],
            [
                'title_en' => 'Night',
                'title_kh' => 'Night',
                'type' => 'time_usage'
            ],

            [
                'title_en' => 'ជម្ងឺផ្លូវដង្ហើម',
                'title_kh' => 'ជម្ងឺផ្លូវដង្ហើម',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'ជម្ងឺ​ ឆ្អឹង	',
                'title_kh' => 'ជម្ងឺ​ ឆ្អឹង	',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'រោគស្ត្រី',
                'title_kh' => 'រោគស្ត្រី',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'ជម្ងឺក្រពេញ',
                'title_kh' => 'ជម្ងឺក្រពេញ',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'ជម្ងឺប្រពន្ឋ័ប្រសាទ',
                'title_kh' => 'ជម្ងឺប្រពន្ឋ័ប្រសាទ',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'ជម្ងឺប្រពន្ឋ័បន្តពូជ',
                'title_kh' => 'ជម្ងឺប្រពន្ឋ័បន្តពូជ',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'ជម្ងឺកុមារ',
                'title_kh' => 'ជម្ងឺកុមារ',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'ជម្ងឺប្រពន្ឋ័ទឹកមូត្រ',
                'title_kh' => 'ជម្ងឺប្រពន្ឋ័ទឹកមូត្រ',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'ជម្ងឺប្រពន្ឋ​រំលាយអាហារ',
                'title_kh' => 'ជម្ងឺប្រពន្ឋ​រំលាយអាហារ',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'skin diseas',
                'title_kh' => 'skin diseas',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'បាំរាស៊ីត',
                'title_kh' => 'បាំរាស៊ីត',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Allergie et immunologie',
                'title_kh' => 'Allergie et immunologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Cardio-vascular disease',
                'title_kh' => 'Cardio-vascular disease',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Chir Pédiatrie',
                'title_kh' => 'Chir Pédiatrie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Chirurgie/ Neurologie',
                'title_kh' => 'Chirurgie/ Neurologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Chirurgie/Thoracique',
                'title_kh' => 'Chirurgie/Thoracique',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Chirurgie/Traumatologie',
                'title_kh' => 'Chirurgie/Traumatologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Chirurgie/Urologie',
                'title_kh' => 'Chirurgie/Urologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Chirurgie/Visérale',
                'title_kh' => 'Chirurgie/Visérale',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Dermatology',
                'title_kh' => 'Dermatology',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Ear Nose Throat',
                'title_kh' => 'Ear Nose Throat',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Endocrinologie',
                'title_kh' => 'Endocrinologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Gastro-Entero-Hematology',
                'title_kh' => 'Gastro-Entero-Hematology',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'General disease',
                'title_kh' => 'General disease',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'General surgery',
                'title_kh' => 'General surgery',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Gynecology/Obstetric',
                'title_kh' => 'Gynecology/Obstetric',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Hématologie',
                'title_kh' => 'Hématologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Infection disease',
                'title_kh' => 'Infection disease',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Internal Medicine',
                'title_kh' => 'Internal Medicine',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Musculoskeletal',
                'title_kh' => 'Musculoskeletal',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Néonatologie',
                'title_kh' => 'Néonatologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Néphrologie',
                'title_kh' => 'Néphrologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Neurologie',
                'title_kh' => 'Neurologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Oncology',
                'title_kh' => 'Oncology',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Ophthalmology',
                'title_kh' => 'Ophthalmology',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Parasitology',
                'title_kh' => 'Parasitology',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Parasitose',
                'title_kh' => 'Parasitose',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Pédiatrie/Cardiologie',
                'title_kh' => 'Pédiatrie/Cardiologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Pédiatrie/Dermatologie',
                'title_kh' => 'Pédiatrie/Dermatologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Pédiatrie/Endocrinologie',
                'title_kh' => 'Pédiatrie/Endocrinologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Pédiatrie/Gasto-entérologie',
                'title_kh' => 'Pédiatrie/Gasto-entérologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Pédiatrie/Hématologie',
                'title_kh' => 'Pédiatrie/Hématologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Pédiatrie/Hépatologie',
                'title_kh' => 'Pédiatrie/Hépatologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Pédiatrie/Infectieux en pédiatrie',
                'title_kh' => 'Pédiatrie/Infectieux en pédiatrie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Pédiatrie/Néphrologie',
                'title_kh' => 'Pédiatrie/Néphrologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Pédiatrie/Neurologie',
                'title_kh' => 'Pédiatrie/Neurologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Pédiatrie/Ophtalmologie',
                'title_kh' => 'Pédiatrie/Ophtalmologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Pédiatrie/Psycose',
                'title_kh' => 'Pédiatrie/Psycose',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Pneumologie',
                'title_kh' => 'Pneumologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Psychology',
                'title_kh' => 'Psychology',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Reproductive health',
                'title_kh' => 'Reproductive health',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Rhumatologie',
                'title_kh' => 'Rhumatologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Specially surgery',
                'title_kh' => 'Specially surgery',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Stomatologies',
                'title_kh' => 'Stomatologies',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Symptom-Cardiovasculaire',
                'title_kh' => 'Symptom-Cardiovasculaire',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Symptome chir',
                'title_kh' => 'Symptome chir',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Symptom-Gastro-intestinal',
                'title_kh' => 'Symptom-Gastro-intestinal',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Symptom-General',
                'title_kh' => 'Symptom-General',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Symptom-Neurologique/Psychologico',
                'title_kh' => 'Symptom-Neurologique/Psychologico',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Symptom-Obstétrique / Gynaecological',
                'title_kh' => 'Symptom-Obstétrique / Gynaecological',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Symptom-Oculaire',
                'title_kh' => 'Symptom-Oculaire',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Symptom-Pulmonaire',
                'title_kh' => 'Symptom-Pulmonaire',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Symptom-Structures cutanées',
                'title_kh' => 'Symptom-Structures cutanées',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Symptom-Urologique',
                'title_kh' => 'Symptom-Urologique',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Symptyome/néphrologie',
                'title_kh' => 'Symptyome/néphrologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Symtome Neurologie',
                'title_kh' => 'Symtome Neurologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Symtome Rhumatologie',
                'title_kh' => 'Symtome Rhumatologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Symtomp/endo',
                'title_kh' => 'Symtomp/endo',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Traumatologie',
                'title_kh' => 'Traumatologie',
                'type' => 'evalutaion_category'
            ],
            [
                'title_en' => 'Urology',
                'title_kh' => 'Urology',
                'type' => 'evalutaion_category'
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
        Schema::dropIfExists('data_parents');
    }
}
