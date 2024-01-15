<?php

namespace App\Livewire;

use App\Models\Pendaftar;
use App\Models\Shop\Product;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\On;
use PhpParser\Node\Stmt\Label;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\isEmpty;

class MulaiPendaftaran extends Component implements HasForms
{
    use InteractsWithForms;


    public $kk = '';
    public $password = '111111';

    public function cek()
    {
        $user = User::where('username', $this->kk);

        if($user !== null) {
            return redirect('/login')->with('username', $this->kk);
        } elseif ($user === null) {
                // $user = new user;
                // $user->name = 'a';
                // $user->username = $this->kk;
                // $user->password = Hash::make($this->password);
                // $user->panelrole = 'psbwalisantri';

                $user = User::create([
                    'name' => 'aaa',
                    'username' => $this->kk,
                    'password' => Hash::make($this->password),
                    'panelrole' => 'psb',
                ]);

                event(new Registered($user));

                Auth::login($user);

                return redirect('/psb');
        }
    }



    public function render(): View
    {
        return view('livewire.mulaipendaftaran');
    }
}
