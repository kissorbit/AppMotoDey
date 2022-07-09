<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Submitlsr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public $table = "Submitlsr";
    public function up()
    {
        if ( Schema::hasTable("Submitlsr") ) {
            $this->down();
            Schema::create("Submitlsr", function (Blueprint $table) {
                $table->increments('id');
                $table->string('nat_transport');$table->integer('estimed_value');$table->integer('tonnage');$table->string('go_destination');$table->string('arrived_destination');$table->string('city_go');$table->string('city_arrival');$table->string('transit');$table->integer('date_loading');$table->string('pick_up_sevice');$table->string('service_delivery');$table->text('notes');
                $table->timestamps();
                $table->softDeletes();
            });
        }
        else{
            Schema::create("Submitlsr", function (Blueprint $table) {
                $table->increments('id');
                $table->string('nat_transport');$table->integer('estimed_value');$table->integer('tonnage');$table->string('go_destination');$table->string('arrived_destination');$table->string('city_go');$table->string('city_arrival');$table->string('transit');$table->integer('date_loading');$table->string('pick_up_sevice');$table->string('service_delivery');$table->text('notes');
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
        Schema::drop('Submitlsr');
    }
}
