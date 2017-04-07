<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->string('factory_id');
            $table->string('elec_scale');
            $table->string('elec_name');
            $table->string('elec_source');
            $table->string('elec_type');
            $table->integer('elec_lastmonth_num');
            $table->integer('elec_currmonth_num');
            $table->integer('elec_copy_num');
            $table->float('elec_cost');
            
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
        //
        Schema::drop('clients');
    }
}
