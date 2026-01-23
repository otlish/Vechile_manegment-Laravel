<x-guest-layout>
    <div class="mb-4 text-center">
        <h4 class="fw-bold text-dark">Welcome Back</h4>
        <p class="text-muted text-sm">Sign in to manage your rentals</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-3 alert alert-success" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label fw-bold small text-uppercase text-muted">Email Address</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="name@example.com">
            <x-input-error :messages="$errors->get('email')" class="text-danger small mt-1" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label fw-bold small text-uppercase text-muted">Password</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="text-danger small mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label small text-muted">Remember me</label>
            </div>
            @if (Route::has('password.request'))
                <a class="text-link small fw-bold" href="{{ route('password.request') }}">
                    Forgot Password?
                </a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary-custom">
            Log in
        </button>

        <div class="text-center mt-4">
            <p class="text-muted small mb-0">Don't have an account? 
                <a href="{{ route('register') }}" class="text-link fw-bold">Register</a>
            </p>
        </div>
    </form>
</x-guest-layout>
