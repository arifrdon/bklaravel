<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;

class CreateTableKejadianSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kejadian_siswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_siswa')->unsigned();
            $table->bigInteger('id_kejadian')->unsigned();
            $table->dateTime('tanggaljam_kejadian');
            $table->smallInteger('status_terkirim')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('kejadian_siswa', function (Blueprint $table) {
            $table->foreign('id_siswa')
            ->references('id')
            ->on('siswa')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

        Schema::table('kejadian_siswa', function (Blueprint $table) {
            $table->foreign('id_kejadian')
            ->references('id')
            ->on('kejadian')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

        $data = array(
            [
                'id_siswa' => '1',
                'id_kejadian' => '1',
                'tanggaljam_kejadian' => Carbon::createFromFormat('Y-m-d H:i:s', '2019-01-23 11:53:20'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id_siswa' => '1',
                'id_kejadian' => '3',
                'tanggaljam_kejadian' => Carbon::createFromFormat('Y-m-d H:i:s', '2019-02-24 11:54:20'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id_siswa' => '1',
                'id_kejadian' => '4',
                'tanggaljam_kejadian' => Carbon::createFromFormat('Y-m-d H:i:s', '2019-03-25 11:55:20'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id_siswa' => '2',
                'id_kejadian' => '3',
                'tanggaljam_kejadian' => Carbon::createFromFormat('Y-m-d H:i:s', '2019-04-26 11:56:20'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id_siswa' => '2',
                'id_kejadian' => '3',
                'tanggaljam_kejadian' => Carbon::createFromFormat('Y-m-d H:i:s', '2019-05-27 11:57:20'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id_siswa' => '2',
                'id_kejadian' => '7',
                'tanggaljam_kejadian' => Carbon::createFromFormat('Y-m-d H:i:s', '2019-06-28 11:58:20'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        );
        
        DB::table('kejadian_siswa')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kejadian_siswa', function (Blueprint $table) {
            $table->dropForeign('kejadian_siswa_id_siswa_foreign');
        });

        Schema::table('kejadian_siswa', function (Blueprint $table) {
            $table->dropForeign('kejadian_siswa_id_kejadian_foreign');
        });

        Schema::dropIfExists('kejadian_siswa');
    }
}
