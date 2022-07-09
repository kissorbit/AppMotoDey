<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Construction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public $table = "Construction";
    public function up()
    {
        if ( Schema::hasTable("Construction") ) {
            $this->down();
            Schema::create("Construction", function (Blueprint $table) {
                $table->increments('id');
                $table->string('company_location');$table->integer('trucks_location');$table->string('rental_location');$table->integer('rental_date');
                $table->timestamps();
                $table->softDeletes();
            });
        }
        else{
            Schema::create("Construction", function (Blueprint $table) {
                $table->increments('id');
                $table->string('company_location');$table->integer('trucks_location');$table->string('rental_location');$table->integer('rental_date');
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
        Schema::drop('Construction');
    }
}
