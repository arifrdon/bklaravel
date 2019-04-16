<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;

class CreateTableKejadian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kejadian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_kejadian',200);
            $table->smallInteger('poin_kejadian');
            $table->enum('tipe_kejadian', ['reward', 'pelanggaran']);
            $table->softDeletes();
            $table->timestamps();
        });

        $data = array(
            [
                'nama_kejadian' => 'Tidur saat jam pelajaran',
                'poin_kejadian' => '6',
                'tipe_kejadian' => 'pelanggaran',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nama_kejadian' => 'Tidak tertib dalam upacara',
                'poin_kejadian' => '5',
                'tipe_kejadian' => 'pelanggaran',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nama_kejadian' => 'Memalsukan data pribadi',
                'poin_kejadian' => '10',
                'tipe_kejadian' => 'pelanggaran',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nama_kejadian' => 'Membawa HP kecuali saat kegiatan ekstrakulikuler',
                'poin_kejadian' => '25',
                'tipe_kejadian' => 'pelanggaran',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nama_kejadian' => 'Membawa/menggunakan/mengedarkan minuman keras/obat terlarang',
                'poin_kejadian' => '75',
                'tipe_kejadian' => 'pelanggaran',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nama_kejadian' => 'Membantu teman yang terluka',
                'poin_kejadian' => '10',
                'tipe_kejadian' => 'reward',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nama_kejadian' => 'Mendapatkan ranking 10 besar dikelas',
                'poin_kejadian' => '20',
                'tipe_kejadian' => 'reward',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nama_kejadian' => 'Mengikuti kegiatan keagamaan',
                'poin_kejadian' => '40',
                'tipe_kejadian' => 'reward',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nama_kejadian' => 'Menjadi panitia kegiatan sekolah',
                'poin_kejadian' => '40',
                'tipe_kejadian' => 'reward',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nama_kejadian' => 'Mendapatkan ranking 3 besar dalam kejuaraan nasional / internasional',
                'poin_kejadian' => '100',
                'tipe_kejadian' => 'reward',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        );
        DB::table('kejadian')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kejadian');
    }
}
