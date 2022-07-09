<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drivers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public $table = "Drivers";
    public function up()
    {
        if ( Schema::hasTable("Drivers") ) {
            $this->down();
            Schema::create("Drivers", function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');$table->integer('numb_phone');$table->string('numb_premit');$table->string('cat_permit');$table->integer('expiry_date');
                $table->timestamps();
                $table->softDeletes();
            });
        }
        else{
            Schema::create("Drivers", function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');$table->integer('numb_phone');$table->string('numb_premit');$table->string('cat_permit');$table->integer('expiry_date');
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
        Schema::drop('Drivers');
    }
}
