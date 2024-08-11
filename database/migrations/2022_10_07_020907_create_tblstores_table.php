<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblstoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblstores', function (Blueprint $table) {
            $table->id();
            $table->String("name");
            $table->String("image")->nullable();
            $table->Integer("quantity");
            $table->Integer("base_price");
            $table->Integer("sale_price");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblstores');
    }
}
