<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Maketrade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public $table = "Maketrade";
    public function up()
    {
        if ( Schema::hasTable("Maketrade") ) {
            $this->down();
            Schema::create("Maketrade", function (Blueprint $table) {
                $table->increments('id');
                $table->integer('choise_lsp');$table->integer('choise_lsr');$table->string('doc_route');
                $table->timestamps();
                $table->softDeletes();
            });
        }
        else{
            Schema::create("Maketrade", function (Blueprint $table) {
                $table->increments('id');
                $table->integer('choise_lsp');$table->integer('choise_lsr');$table->string('doc_route');
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
        Schema::drop('Maketrade');
    }
}
