<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcelUploadedDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excel-uploaded-data', function (Blueprint $table) {
            $table->id();
            $table->string('sapid', 18);
            $table->string('hostname', 14);
            $table->string('loopback', 45);
            $table->string('macaddress', 17);
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
        Schema::dropIfExists('excel-uploaded-data');
    }
}
