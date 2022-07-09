<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Truckconstruction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public $table = "Truckconstruction";
    public function up()
    {
        if ( Schema::hasTable("Truckconstruction") ) {
            $this->down();
            Schema::create("Truckconstruction", function (Blueprint $table) {
                $table->increments('id');
                $table->string('type_truck');
                $table->timestamps();
                $table->softDeletes();
            });
        }
        else{
            Schema::create("Truckconstruction", function (Blueprint $table) {
                $table->increments('id');
                $table->string('type_truck');
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
        Schema::drop('Truckconstruction');
    }
}
