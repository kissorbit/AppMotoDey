<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Transportgoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public $table = "Transportgoods";
    public function up()
    {
        if ( Schema::hasTable("Transportgoods") ) {
            $this->down();
            Schema::create("Transportgoods", function (Blueprint $table) {
                $table->increments('id');
                $table->string('transportgoods');
                $table->timestamps();
                $table->softDeletes();
            });
        }
        else{
            Schema::create("Transportgoods", function (Blueprint $table) {
                $table->increments('id');
                $table->string('transportgoods');
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
        Schema::drop('Transportgoods');
    }
}
