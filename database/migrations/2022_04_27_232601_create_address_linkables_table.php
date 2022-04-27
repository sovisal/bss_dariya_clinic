<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressLinkablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_linkables', function (Blueprint $table) {
            $table->id();
            $table->string('village_en')->nullable();
            $table->string('village_kh')->nullable();
            $table->string('village_code')->nullable();
            $table->string('commune_en')->nullable();
            $table->string('commune_kh')->nullable();
            $table->string('commune_code')->nullable();
            $table->string('district_en')->nullable();
            $table->string('district_kh')->nullable();
            $table->string('district_code')->nullable();
            $table->string('province_en')->nullable();
            $table->string('province_kh')->nullable();
            $table->string('province_code')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('address_linkables');
    }
}
