<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Lsps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public $table = "Lsps";
    public function up()
    {
        if ( Schema::hasTable("Lsps") ) {
            $this->down();
            Schema::create("Lsps", function (Blueprint $table) {
                $table->increments('id');
                $table->string('compagny_name_lsp');$table->string('compagny_address_lsp');$table->string('name_lsp');$table->string('first_name_lsp');$table->string('email_lsp');$table->string('phone_lsp');$table->string('country_lsp');$table->string('city_lsp');
                $table->timestamps();
                $table->softDeletes();
            });
        }
        else{
            Schema::create("Lsps", function (Blueprint $table) {
                $table->increments('id');
                $table->string('compagny_name_lsp');$table->string('compagny_address_lsp');$table->string('name_lsp');$table->string('first_name_lsp');$table->string('email_lsp');$table->string('phone_lsp');$table->string('country_lsp');$table->string('city_lsp');
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
        Schema::drop('Lsps');
    }
}
