<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;

class CreateForumKejadianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_kejadian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_kejadian_siswa')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->string('komentar',500);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('forum_kejadian', function (Blueprint $table) {
            $table->foreign('id_kejadian_siswa')
            ->references('id')
            ->on('kejadian_siswa')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
        Schema::table('forum_kejadian', function (Blueprint $table) {
            $table->foreign('id_user')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

        $data = array(
            [
                'id_kejadian_siswa' => '6',
                'id_user' => '1',
                'komentar' => 'Mohon diperhatikan anaknya',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        );
        
        DB::table('forum_kejadian')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forum_kejadian', function (Blueprint $table) {
            $table->dropForeign('forum_kejadian_id_kejadian_siswa_foreign');
        });

        Schema::table('forum_kejadian', function (Blueprint $table) {
            $table->dropForeign('forum_kejadian_id_user_foreign');
        });

        Schema::dropIfExists('forum_kejadian');
    }
}
