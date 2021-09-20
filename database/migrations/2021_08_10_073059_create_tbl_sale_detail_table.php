<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSaleDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sale_detail', function (Blueprint $table) {
            $table->increments('sale_detail_id');
            $table->integer('sale_id');
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->integer('percent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_sale_detail');
    }
}
