<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVanBanDensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('van_ban_den', function (Blueprint $table) {
            $table->id();
            $table->string('id_nguon_den');
            $table->string('so');
            $table->date('ngay');
            $table->integer('id_loai');
            $table->string('trich_yeu',450);
            $table->string('noi_dung');
            $table->string('nguoi_ky');
            $table->integer('do_mat');
            $table->string('file',150);
            $table->string('phe_duyet',250);
            $table->integer('id_user_xu_ly');
            $table->date('han_xu_ly');
            $table->string('trang_thai',350);
            $table->string('ghi_chu',350);
            $table->string('luu_tru',200);
            $table->string('nguoi_nhap',50);
            $table->softDeletes();
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
        Schema::dropIfExists('van_ban_den');
    }
}
