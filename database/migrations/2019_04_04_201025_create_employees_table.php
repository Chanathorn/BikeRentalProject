<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::defaultStringLength(70);
        Schema::create('employees', function (Blueprint $table) {
            $table->string('id_employees');
            $table->string('id_card')->unique();
            $table->string('name_employees');
            $table->string('lastname');
            $table->string('gender');
            $table->string('mobile');
            $table->string('address');
            $table->string('name');
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
        Schema::dropIfExists('employees');
    }
}
