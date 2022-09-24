<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caycanh', function (Blueprint $table) {
            $table->id('MaCay');
            $table->integer('MaLoaiCay');
            $table->longText('TenCay');
            $table->integer('SoLuong');
            $table->integer('DonGiaBan');
            $table->longText('XuatXu');
            $table->longText('HinhAnh')->nullable();
            $table->longText('MoTa')->nullable();
            $table->longText('HuongDan')->nullable();
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
        Schema::dropIfExists('caycanh');
    }
};
