<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Agriculture extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public $table = "Agriculture";
    public function up()
    {
        if ( Schema::hasTable("Agriculture") ) {
            $this->down();
            Schema::create("Agriculture", function (Blueprint $table) {
                $table->increments('id');
                $table->string('nature');$table->string('desired_delivery');$table->integer('contact_user');$table->integer('transportgoods');$table->integer('quantity');
                $table->timestamps();
                $table->softDeletes();
            });
        }
        else{
            Schema::create("Agriculture", function (Blueprint $table) {
                $table->increments('id');
                $table->string('nature');$table->string('desired_delivery');$table->integer('contact_user');$table->integer('transportgoods');$table->integer('quantity');
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
        Schema::drop('Agriculture');
    }
}
