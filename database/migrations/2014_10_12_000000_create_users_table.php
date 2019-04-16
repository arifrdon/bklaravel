<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('level', ['guru', 'kepala_sekolah', 'guru_bk', 'admin', 'orang_tua']);
            $table->string('nomor_telepon')->unique();
            $table->text('alamat');
            $table->rememberToken();
            $table->timestamps();
        });

        

        $data = array(
            [
                'username' => '1134010039',
                'name' => 'Supardi',
                'email' => 'supardi@supardi.com',
                'password' => bcrypt('1134010039'),
                'level' => 'kepala_sekolah',
                'nomor_telepon' => '081111111111',
                'alamat' => 'Jl Alpukat',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'username' => '1234010039',
                'name' => 'Lia Andriani',
                'email' => 'liaandriani@liaandriani.com',
                'password' => bcrypt('1234010039'),
                'level' => 'guru_bk',
                'nomor_telepon' => '081111111112',
                'alamat' => 'Jl Mangga',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'username' => '1334010039',
                'name' => 'Tuti Wibowo',
                'email' => 'tutiwibowo@tutiwibowo.com',
                'password' => bcrypt('1334010039'),
                'level' => 'guru',
                'nomor_telepon' => '081111111113',
                'alamat' => 'Jl Apel',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'username' => '1434010039',
                'name' => 'Suwandi',
                'email' => 'suwandi@suwandi.com',
                'password' => bcrypt('1434010039'),
                'level' => 'guru',
                'nomor_telepon' => '081111111114',
                'alamat' => 'Jl Melon',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'username' => '1534010039',
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('1534010039'),
                'level' => 'admin',
                'nomor_telepon' => '081111111115',
                'alamat' => 'Jl Rambutan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'username' => '1634010039',
                'name' => 'Joko',
                'email' => 'joko@joko.com',
                'password' => bcrypt('1634010039'),
                'level' => 'guru',
                'nomor_telepon' => '081111111116',
                'alamat' => 'Jl Melon',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'username' => '1734010039',
                'name' => 'Marni',
                'email' => 'marni@marni.com',
                'password' => bcrypt('1734010039'),
                'level' => 'orang_tua',
                'nomor_telepon' => '081111111117',
                'alamat' => 'Jl Melon',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'username' => '1834010039',
                'name' => 'Margaretha',
                'email' => 'margaretha@margaretha.com',
                'password' => bcrypt('1834010039'),
                'level' => 'orang_tua',
                'nomor_telepon' => '081111111118',
                'alamat' => 'Jl Melon',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'username' => '1934010039',
                'name' => 'Agatha',
                'email' => 'agatha@agatha.com',
                'password' => bcrypt('1934010039'),
                'level' => 'orang_tua',
                'nomor_telepon' => '081111111119',
                'alamat' => 'Jl Melon',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        );
        
        DB::table('users')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
        Schema::dropIfExists('users');
    }
}
