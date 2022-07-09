<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Submitlsp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public $table = "Submitlsp";
    public function up()
    {
        if ( Schema::hasTable("Submitlsp") ) {
            $this->down();
            Schema::create("Submitlsp", function (Blueprint $table) {
                $table->increments('id');
                $table->integer('number_trucks');$table->string('type_trucks');$table->string('tax');
                $table->timestamps();
                $table->softDeletes();
            });
        }
        else{
            Schema::create("Submitlsp", function (Blueprint $table) {
                $table->increments('id');
                $table->integer('number_trucks');$table->string('type_trucks');$table->string('tax');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Submitlsp');
    }
}
