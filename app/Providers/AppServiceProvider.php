<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Pengaturan_bk;
use App\Kelassw;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Config::set('poin_awal', Pengaturan_bk::where('id' , 1)->value('nilai_pengaturan'));
        Config::set('fitur_reward', Pengaturan_bk::where('id' , 2)->value('nilai_pengaturan'));
        Config::set('operator_bk', Pengaturan_bk::where('id' , 3)->value('nilai_pengaturan'));
        Config::set('wali_list', Kelassw::pluck('id_wali_kelas'));
    }
}
