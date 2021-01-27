<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Auth;
use\App\box;
use\App\user;

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
        view()->composer('admin.admin-master', function ($view)
        {

           // $lokasi = Auth::user()->lokasi;           
           // $lkstotal=LKS::where('lokasi',$lokasi)->where('status','Terkirim')->get()->count();
           //  $view->with('lkstotal', $lkstotal);

            if ( Auth::user()->role == "admin") {
                 
                $id_box=Auth::user()->id_box;
                $box=box::find($id_box);
                $kode_box=$box->kode_box;
            }
            else {

                $kode_box="-";
            }
            $view->with('kode_box', $kode_box);

            
            // $my_footer = <<<EOD
            // <p class="mt-0">Made with <span  >❤</span> by  <a href="mailto:ahmad.m.khoiri@gmail.com">ahmad.m.khoiri@gmail.com</a> </p>
            // EOD;

            $konfigurasi ='<footer class="main-footer" style="font-size:15px;" ><div class="float-right d-none d-sm-block">
      <b>DinArt</b> 2021.
    </div><p class="mt-0">Made with <span style="font-size:11px;" >❤</span>   <a data-toggle="tooltip" data-placement="top" title="send me an email? click this!"  style="text-decoration: none; color:grey;" href="mailto:ahmad.m.khoiri@gmail.com">ahmad.m.khoiri@gmail.com</a> </p> </footer>';

            $view->with('konfigurasi', $konfigurasi);
            
        });






        view()->composer('cs.cs-master', function ($view)
        {

           // $lokasi = Auth::user()->lokasi;           
           // $lkstotal=LKS::where('lokasi',$lokasi)->where('status','Terkirim')->get()->count();
           //  $view->with('lkstotal', $lkstotal);

            if (Auth::user()->role == "cs" ) {
                 
                $id_box=Auth::user()->id_box;
                $box=box::find($id_box);
                $kode_box=$box->kode_box;
            }
            else {

                $kode_box="-";
            }
            $view->with('kode_box', $kode_box);

            
            // $my_footer = <<<EOD
            // <p class="mt-0">Made with <span  >❤</span> by  <a href="mailto:ahmad.m.khoiri@gmail.com">ahmad.m.khoiri@gmail.com</a> </p>
            // EOD;

            $konfigurasi ='<footer class="main-footer" style="font-size:15px;" ><div class="float-right d-none d-sm-block">
      <b>DinArt</b> 2021.
    </div><p class="mt-0">Made with <span style="font-size:11px;" >❤</span>   <a data-toggle="tooltip" data-placement="top" title="send me an email? click this!"  style="text-decoration: none; color:grey;" href="mailto:ahmad.m.khoiri@gmail.com">ahmad.m.khoiri@gmail.com</a> </p> </footer>';

            $view->with('konfigurasi', $konfigurasi);
            
        });






        view()->composer('produksi.produksi-master', function ($view)
        {

           // $lokasi = Auth::user()->lokasi;           
           // $lkstotal=LKS::where('lokasi',$lokasi)->where('status','Terkirim')->get()->count();
           //  $view->with('lkstotal', $lkstotal);

            if (Auth::user()->role == "cs" ) {
                 
                $id_box=Auth::user()->id_box;
                $box=box::find($id_box);
                $kode_box=$box->kode_box;
            }
            else {

                $kode_box="-";
            }
            $view->with('kode_box', $kode_box);

            
            // $my_footer = <<<EOD
            // <p class="mt-0">Made with <span  >❤</span> by  <a href="mailto:ahmad.m.khoiri@gmail.com">ahmad.m.khoiri@gmail.com</a> </p>
            // EOD;

            $konfigurasi ='<footer class="main-footer" style="font-size:15px;" ><div class="float-right d-none d-sm-block">
      <b>DinArt</b> 2021.
    </div><p class="mt-0">Made with <span style="font-size:11px;" >❤</span>   <a data-toggle="tooltip" data-placement="top" title="send me an email? click this!"  style="text-decoration: none; color:grey;" href="mailto:ahmad.m.khoiri@gmail.com">ahmad.m.khoiri@gmail.com</a> </p> </footer>';

            $view->with('konfigurasi', $konfigurasi);
            
        });






        
    }
}
