<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Selectlsr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public $table = "Selectlsr";
    public function up()
    {
        if ( Schema::hasTable("Selectlsr") ) {
            $this->down();
            Schema::create("Selectlsr", function (Blueprint $table) {
                $table->increments('id');
                $table->integer('select');$table->string('nature_material');
                $table->timestamps();
                $table->softDeletes();
            });
        }
        else{
            Schema::create("Selectlsr", function (Blueprint $table) {
                $table->increments('id');
                $table->integer('select');$table->string('nature_material');
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
        Schema::drop('Selectlsr');
    }
}
