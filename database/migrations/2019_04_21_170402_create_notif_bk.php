<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;

class CreateNotifBk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notif_bk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_forum')->unsigned();
            $table->enum('sudah_baca', ['0', '1'])->default(0);
            $table->timestamps();
        });
        Schema::table('notif_bk', function (Blueprint $table) {
            $table->foreign('id_forum')
            ->references('id')
            ->on('forum_kejadian')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
        $data = array(
            [
                'id_forum' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        );
        
        DB::table('notif_bk')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notif_bk', function (Blueprint $table) {
            $table->dropForeign('notif_bk_id_forum_foreign');
        });
        
        Schema::dropIfExists('notif_bk');
    }
}
