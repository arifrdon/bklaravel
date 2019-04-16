<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;

class CreateTableKelassw extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelassw', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_kelas');
            $table->bigInteger('id_wali_kelas')->unsigned();
            $table->timestamps();
        });

        Schema::table('kelassw', function (Blueprint $table) {
            $table->foreign('id_wali_kelas')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

        $data = array(
            [
                'nama_kelas' => 'A',
                'id_wali_kelas' => '3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nama_kelas' => 'B',
                'id_wali_kelas' => '4',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        );
        
        DB::table('kelassw')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelassw', function (Blueprint $table) {
            $table->dropForeign('kelassw_id_wali_kelas_foreign');
        });

        Schema::dropIfExists('kelassw');
    }
}
