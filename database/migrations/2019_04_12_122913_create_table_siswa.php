<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;

class CreateTableSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('nisn')->unique()->unsigned();
            $table->bigInteger('id_ortu')->unsigned();
            $table->bigInteger('id_kelas')->unsigned();
            $table->string('nama_siswa',200);
            $table->string('tempat_lahir',200);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L','P']);
            $table->timestamps();
        });

        Schema::table('siswa', function (Blueprint $table) {
            $table->foreign('id_kelas')
            ->references('id')
            ->on('kelassw')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

        Schema::table('siswa', function (Blueprint $table) {
            $table->foreign('id_ortu')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

        $data = array(
            [
                'nisn' => '1111',
                'id_ortu' => '7',
                'id_kelas' => '1',
                'nama_siswa' => 'Adinda Setiawan',
                'tempat_lahir' => 'Mojokerjo',
                'tanggal_lahir' => '1997-01-01',
                'jenis_kelamin' => 'L',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nisn' => '1112',
                'id_ortu' => '8',
                'id_kelas' => '2',
                'nama_siswa' => 'Febri Windi',
                'tempat_lahir' => 'Banten',
                'tanggal_lahir' => '1997-02-02',
                'jenis_kelamin' => 'P',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nisn' => '1113',
                'id_ortu' => '9',
                'id_kelas' => '1',
                'nama_siswa' => 'Yolanda Kusuma',
                'tempat_lahir' => 'Solo',
                'tanggal_lahir' => '1997-03-03',
                'jenis_kelamin' => 'P',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        );
        
        DB::table('siswa')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropForeign('siswa_id_kelas_foreign');
        });

        Schema::table('siswa', function (Blueprint $table) {
            $table->dropForeign('siswa_id_ortu_foreign');
        });

        Schema::dropIfExists('siswa');
    }
}
