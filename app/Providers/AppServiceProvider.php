<?php

namespace App\Providers;

use App\Filament\MyLogoutResponse;
use App\Livewire\DaftarTa;
use App\Livewire\DaftarTN;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(LogoutResponseContract::class, MyLogoutResponse::class);

        Livewire::component('daftarta', DaftarTa::class);
        Livewire::component('daftartn', DaftarTN::class);
        Model::unguard();
    }
}
