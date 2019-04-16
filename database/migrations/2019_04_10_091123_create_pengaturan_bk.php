<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;

class CreatePengaturanBk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaturan_bk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_pengaturan');
            $table->string('nilai_pengaturan');
            $table->timestamps();
        });

        $data = array(
            [
                'nama_pengaturan' => 'Poin Awal Siswa',
                'nilai_pengaturan' => '100',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nama_pengaturan' => 'Fitur Reward',
                'nilai_pengaturan' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nama_pengaturan' => 'Operator Pelanggaran',
                'nilai_pengaturan' => 'kurang',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        );
        
        DB::table('pengaturan_bk')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaturan_bk');
    }
}
