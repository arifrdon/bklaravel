<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Request;

class MenuHighlightServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $halaman="";
        if(Request::segment(1) == "kejadian")
        {
            $halaman="kejadian";
        }
        if(Request::segment(1) == "kejadian_siswa")
        {
            $halaman="kejadian_siswa";
        }
        if(Request::segment(1) == "skor_siswa")
        {
            $halaman="skor_siswa";
        }
        if(Request::segment(1) == "laporan_kejadian")
        {
            $halaman="laporan_kejadian";
        }
        if(Request::segment(1) == "pengaturan_bk")
        {
            $halaman="pengaturan_bk";
        }
        view()->share('halaman', $halaman);
    }
}
