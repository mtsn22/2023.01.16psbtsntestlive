<?php

namespace App\Http\Requests\Auth;

use App\Models\Santri;
use App\Models\User;
use App\Models\Walisantri;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // return [
        //     'email' => ['required', 'string', 'email'],
        //     'password' => ['required', 'string'],
        // ];

        return [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {

        $this->ensureIsNotRateLimited();

        $user = User::where('username', $this->username)->first();

        $password = Str::camel($this->password);

        if ($user !== null) {
            $credentials = [
                'username' => $this->username,
                'password' => $password,
            ];

            // dd($credentials);


            if (!Auth::attempt($credentials, $this->boolean('remember'))) {
                // dd($this->only('username','password'));
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'email' => trans('auth.failed'),
                ]);
            }
            RateLimiter::clear($this->throttleKey());
        } elseif ($user === null) {
            $user = User::create([
                'name' => 'Calon Walisantri',
                'username' => $this->username,
                'password' => $password,
                'panelrole' => 'psb',
            ]);

            // dd($user);

            event(new Registered($user));

            Auth::login($user);

            // return redirect('/psb');

        }
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')) . '|' . $this->ip());
    }
}
