<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        //usar apenas depois que o banco tiver sido importado

        /*
        $dataHoje = today();
        $chamadosPendentes = DB::table('chamados')
                                ->where('dt_abertura', $dataHoje)
                                ->where('status', '<', 3)
                                ->count();
        */
        $chamadosPendentes = 1;
        \View::share('chamadosPendentes', $chamadosPendentes);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
