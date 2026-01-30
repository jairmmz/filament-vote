<?php


use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

new #[Layout('layouts::auth', ['title' => 'Registro'])] class extends Component {
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|string|email|unique:users,email')]
    public string $email = '';

    #[Validate('required|string|confirmed|min:8')]
    public string $password = '';

    #[Validate('required|string|min:8')]
    public string $password_confirmation = '';

    /**
     * Handle an incoming authentication request.
     */

    public function register(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        RateLimiter::clear($this->throttleKey());

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'status' => true,
        ]);

        $user->assignRole(User::ROLE_USER);

        $user->sendEmailVerificationNotification();

        Auth::login($user);

        Session::regenerate();

        $this->redirectIntended(default: route('verify-email', absolute: false), navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
};
?>

<div class="flex flex-col gap-6">
    <flux:heading class="text-center" size="xl">Crear cuenta</flux:heading>

    <div class="space-y-4">
        <flux:button class="w-full" href="{{ route('auth.google.redirect') }}">
            <x-slot name="icon">
                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M23.06 12.25C23.06 11.47 22.99 10.72 22.86 10H12.5V14.26H18.42C18.16 15.63 17.38 16.79 16.21 17.57V20.34H19.78C21.86 18.42 23.06 15.6 23.06 12.25Z"
                        fill="#4285F4" />
                    <path
                        d="M12.4997 23C15.4697 23 17.9597 22.02 19.7797 20.34L16.2097 17.57C15.2297 18.23 13.9797 18.63 12.4997 18.63C9.63969 18.63 7.20969 16.7 6.33969 14.1H2.67969V16.94C4.48969 20.53 8.19969 23 12.4997 23Z"
                        fill="#34A853" />
                    <path
                        d="M6.34 14.0899C6.12 13.4299 5.99 12.7299 5.99 11.9999C5.99 11.2699 6.12 10.5699 6.34 9.90995V7.06995H2.68C1.93 8.54995 1.5 10.2199 1.5 11.9999C1.5 13.7799 1.93 15.4499 2.68 16.9299L5.53 14.7099L6.34 14.0899Z"
                        fill="#FBBC05" />
                    <path
                        d="M12.4997 5.38C14.1197 5.38 15.5597 5.94 16.7097 7.02L19.8597 3.87C17.9497 2.09 15.4697 1 12.4997 1C8.19969 1 4.48969 3.47 2.67969 7.07L6.33969 9.91C7.20969 7.31 9.63969 5.38 12.4997 5.38Z"
                        fill="#EA4335" />
                </svg>
            </x-slot>
            Continuar con Google
        </flux:button>
    </div>

    <flux:separator text="Iniciar sesión con" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="name"
            name="name"
            size="sm"
            :label="__('Nombres y Apellidos')"
            required
            autofocus
            autocomplete="name"
            placeholder="Nombres y Apellidos"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            name="email"
            size="sm"
            :label="__('Email address')"
            type="email"
            required
            autofocus
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Password -->
        <flux:input
            type="password"
            wire:model="password"
            name="password"
            size="sm"
            :label="__('Password')"
            required
            autocomplete="current-password"
            :placeholder="__('Password')"
            viewable
        />

        <!-- Password  confirmation -->
        <flux:input
            type="password"
            wire:model="password_confirmation"
            name="password_confirmation"
            size="sm"
            :label="__('Password confirmation')"
            required
            autocomplete="current-password"
            :placeholder="__('Password confirmation')"
            viewable
        />

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full" data-test="register-button">
                {{ __('Register') }}
            </flux:button>
        </div>

        <flux:subheading class="text-center">
            Ya tienes una cuenta? <flux:link href="{{ route('login') }}" wire:navigate>Iniciar sesión</flux:link>
        </flux:subheading>
    </form>
</div>
