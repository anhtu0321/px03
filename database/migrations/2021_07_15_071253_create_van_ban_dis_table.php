<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVanBanDisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('van_ban_di', function (Blueprint $table) {
            $table->id();
            $table->string('so');
            $table->date('ngay');
            $table->string('trich_yeu', 450);
            $table->integer('id_loai');
            $table->string('noi_dung');
            $table->integer('id_lanh_dao');
            $table->integer('do_mat');
            $table->string('can_bo_tham_muu',50);
            $table->string('file',150);
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
        Schema::dropIfExists('van_ban_di');
    }
}
